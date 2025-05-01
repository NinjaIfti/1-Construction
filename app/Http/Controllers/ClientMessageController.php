<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ClientMessageController extends Controller
{
    /**
     * Display a listing of the messages.
     */
    public function index()
    {
        $user = Auth::user();
        $messages = Message::where(function ($query) use ($user) {
                $query->where('sender_id', $user->id)
                    ->orWhere('recipient_id', $user->id);
            })
            ->whereNull('parent_id') // Only show parent messages in the list
            ->latest()
            ->paginate(10);

        return view('layouts.client.messages.index', compact('messages'));
    }

    /**
     * Show the form for creating a new message.
     */
    public function create()
    {
        $admins = User::where('role', 'admin')->get();
        return view('layouts.client.messages.create', compact('admins'));
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
        
        $message = Message::create([
            'subject' => $request->subject,
            'content' => $request->content,
            'sender_id' => $user->id,
            'recipient_id' => $request->recipient_id,
            'contractor_id' => $user->isContractor() ? $user->id : null,
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
                    'contractor_id' => $user->isContractor() ? $user->id : null
                ]);
            }
        }

        return redirect()->route('client.messages.show', $message)
            ->with('success', 'Message sent successfully.');
    }

    /**
     * Display the specified message.
     */
    public function show(Message $message)
    {
        $user = Auth::user();
        
        // Check if user is authorized to view this message
        if ($message->sender_id !== $user->id && $message->recipient_id !== $user->id) {
            return redirect()->route('client.messages.index')
                ->with('error', 'You are not authorized to view this message.');
        }

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

        return view('layouts.client.messages.show', compact('message', 'conversation'));
    }

    /**
     * Show the form for replying to a message.
     */
    public function reply(Message $message)
    {
        $user = Auth::user();
        
        // Check if user is authorized to reply to this message
        if ($message->sender_id !== $user->id && $message->recipient_id !== $user->id) {
            return redirect()->route('client.messages.index')
                ->with('error', 'You are not authorized to reply to this message.');
        }

        return view('layouts.client.messages.reply', compact('message'));
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
            'contractor_id' => $user->isContractor() ? $user->id : null,
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
                    'contractor_id' => $user->isContractor() ? $user->id : null
                ]);
            }
        }

        return redirect()->route('client.messages.show', $parentMessage)
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