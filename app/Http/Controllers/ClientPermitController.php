<?php

namespace App\Http\Controllers;

use App\Models\Permit;
use App\Models\Project;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ClientPermitController extends Controller
{
    /**
     * Display the permit submission form.
     */
    public function create()
    {
        $user = Auth::user();
        $projects = $user->projects;
        
        return view('layouts.client.permits.create', compact('projects'));
    }

    /**
     * Store a newly created permit in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'type' => 'required|string|max:255',
            'description' => 'nullable|string',
            'documents.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:10240',
        ]);
        
        $project = Project::findOrFail($validated['project_id']);
        
        // Check if user owns the project
        if ($project->user_id !== Auth::id()) {
            return redirect()->route('client.permits.create')
                ->with('error', 'You are not authorized to create permits for this project.');
        }
        
        // Generate a unique permit number
        $validated['permit_number'] = 'PER-' . now()->format('Ymd') . '-' . strtoupper(substr(uniqid(), -5));
        $validated['status'] = 'Pending';
        $validated['submission_date'] = now();
        
        $permit = $project->permits()->create($validated);
        
        // Handle document uploads
        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $file) {
                $path = $file->store('permits/' . $permit->id, 'public');
                
                $permit->documents()->create([
                    'name' => $file->getClientOriginalName(),
                    'file_path' => $path,
                    'file_type' => $file->getMimeType(),
                    'file_size' => $file->getSize(),
                    'uploaded_by' => Auth::id(),
                ]);
            }
        }
        
        // Create notification for permit creation
        Notification::create([
            'user_id' => $project->user_id,
            'permit_id' => $permit->id,
            'title' => 'New Permit Submitted',
            'message' => "A new permit ({$permit->permit_number}) has been submitted for project: {$project->name}",
            'type' => 'permit_submission',
        ]);
        
        // Create notification for admin users
        $admins = User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            Notification::create([
                'user_id' => $admin->id,
                'permit_id' => $permit->id,
                'title' => 'New Permit Requires Review',
                'message' => "A new permit ({$permit->permit_number}) has been submitted by {$project->user->name} for project: {$project->name}",
                'type' => 'permit_review',
            ]);
        }
        
        return redirect()->route('client.permits.index')
            ->with('success', 'Permit submitted successfully. It is now pending review.');
    }

    /**
     * Display a listing of the user's permits.
     */
    public function index()
    {
        $permits = Permit::whereHas('project', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->with('project')
            ->latest()
            ->paginate(10);
            
        return view('layouts.client.permits.index', compact('permits'));
    }

    /**
     * Display the specified permit.
     */
    public function show(Permit $permit)
    {
        // Check if user owns the project associated with the permit
        if ($permit->project->user_id !== Auth::id()) {
            return redirect()->route('client.permits.index')
                ->with('error', 'You are not authorized to view this permit.');
        }
        
        $permit->load(['project', 'documents', 'comments.user']);
        
        return view('layouts.client.permits.show', compact('permit'));
    }

    /**
     * Add a comment to a permit.
     */
    public function addComment(Request $request, Permit $permit)
    {
        // Check if user owns the project associated with the permit
        if ($permit->project->user_id !== Auth::id()) {
            return redirect()->route('client.permits.index')
                ->with('error', 'You are not authorized to comment on this permit.');
        }
        
        $validated = $request->validate([
            'content' => 'required|string',
        ]);
        
        $comment = $permit->comments()->create([
            'user_id' => Auth::id(),
            'content' => $validated['content'],
        ]);
        
        // Create notification for admin users
        $admins = User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            Notification::create([
                'user_id' => $admin->id,
                'permit_id' => $permit->id,
                'title' => 'New Comment on Permit',
                'message' => "A new comment has been added to permit {$permit->permit_number} by " . Auth::user()->name,
                'type' => 'comment',
            ]);
        }
        
        return redirect()->route('client.permits.show', $permit)
            ->with('success', 'Comment added successfully.');
    }
} 