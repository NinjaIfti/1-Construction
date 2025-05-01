<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Message;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class AdminMessageController extends Controller
{
    /**
     * Display a listing of the messages organized by contractor.
     */
    public function index()
    {
        $contractors = User::where('role', 'contractor')
            ->whereHas('contractorMessages')
            ->with(['contractorMessages' => function ($query) {
                $query->whereNull('parent_id')
                    ->latest();
            }])
            ->get();

        return view('layouts.admin.messages.index', compact('contractors'));
    }

    /**
     * Display messages for a specific contractor.
     */
    public function contractorMessages(User $contractor)
    {
        if ($contractor->role !== 'contractor') {
            return redirect()->route('admin.messages.index')
                ->with('error', 'Selected user is not a contractor.');
        }

        $messages = Message::where('contractor_id', $contractor->id)
            ->whereNull('parent_id')
            ->latest()
            ->paginate(10);

        return view('layouts.admin.messages.contractor', compact('contractor', 'messages'));
    }

    /**
     * Show the form for creating a new message.
     */
    public function create()
    {
        $contractors = User::where('role', 'contractor')->get();
        return view('layouts.admin.messages.create', compact('contractors'));
    }

    /**
     * Store a newly created message in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'content' => 'required|string',
            'recipient_id' => 'required|exists:users,id',
            'attachments.*' => 'nullable|file|max:10240', // 10MB max per file
        ]);

        $user = Auth::user();
        
        // Determine contractor_id
        $recipient = User::find($request->recipient_id);
        $contractor_id = $recipient->isContractor() ? $recipient->id : null;

        $message = Message::create([
            'subject' => $request->subject,
            'content' => $request->content,
            'sender_id' => $user->id,
            'recipient_id' => $request->recipient_id,
            'contractor_id' => $contractor_id,
            'has_attachment' => $request->hasFile('attachments')
        ]);

        // Handle file uploads
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $path = $file->store('messages/' . $message->id, 'public');
                
                Document::create([
                    'name' => $file->getClientOriginalName(),
                    'file_path' => $path,
                    'file_size' => $file->getSize(),
                    'file_type' => $file->getMimeType(),
                    'uploaded_by' => $user->id,
                    'message_id' => $message->id,
                    'contractor_id' => $contractor_id
                ]);
            }
        }

        return redirect()->route('admin.messages.show', $message)
            ->with('success', 'Message sent successfully.');
    }

    /**
     * Display the specified message.
     */
    public function show(Message $message)
    {
        $user = Auth::user();
        
        // Mark as read if recipient is viewing
        if ($message->recipient_id === $user->id && $message->read_at === null) {
            $message->markAsRead();
        }

        // Get conversation (parent + replies)
        $conversation = collect([$message]);
        
        if ($message->parent_id) {
            $parent = Message::with('replies')->find($message->parent_id);
            $conversation = collect([$parent])->merge($parent->replies);
        } else {
            $replies = $message->replies()->orderBy('created_at')->get();
            $conversation = $conversation->merge($replies);
        }

        return view('layouts.admin.messages.show', compact('message', 'conversation'));
    }

    /**
     * Show the form for replying to a message.
     */
    public function reply(Message $message)
    {
        return view('layouts.admin.messages.reply', compact('message'));
    }

    /**
     * Store a reply to a message.
     */
    public function storeReply(Request $request, Message $message)
    {
        $request->validate([
            'content' => 'required|string',
            'attachments.*' => 'nullable|file|max:10240', // 10MB max per file
        ]);

        $user = Auth::user();
        
        // Determine recipient (the other person in the conversation)
        $recipient_id = ($message->sender_id === $user->id) 
            ? $message->recipient_id 
            : $message->sender_id;

        // If replying to a reply, use the parent message's subject
        $parentMessage = $message->parent_id ? Message::find($message->parent_id) : $message;
        
        $reply = Message::create([
            'subject' => 'Re: ' . $parentMessage->subject,
            'content' => $request->content,
            'sender_id' => $user->id,
            'recipient_id' => $recipient_id,
            'parent_id' => $parentMessage->id,
            'contractor_id' => $parentMessage->contractor_id,
            'has_attachment' => $request->hasFile('attachments')
        ]);

        // Handle file uploads
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $path = $file->store('messages/' . $reply->id, 'public');
                
                Document::create([
                    'name' => $file->getClientOriginalName(),
                    'file_path' => $path,
                    'file_size' => $file->getSize(),
                    'file_type' => $file->getMimeType(),
                    'uploaded_by' => $user->id,
                    'message_id' => $reply->id,
                    'contractor_id' => $parentMessage->contractor_id
                ]);
            }
        }

        return redirect()->route('admin.messages.show', $parentMessage)
            ->with('success', 'Reply sent successfully.');
    }

    /**
     * Get unread message count for navbar notification.
     */
    public function unreadCount()
    {
        $user = Auth::user();
        $count = Message::where('recipient_id', $user->id)
            ->whereNull('read_at')
            ->count();
            
        return response()->json(['count' => $count]);
    }
} 