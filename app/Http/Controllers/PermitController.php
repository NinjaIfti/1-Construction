<?php

namespace App\Http\Controllers;

use App\Models\Permit;
use App\Models\Project;
use App\Models\Comment;
use App\Models\Document;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PermitController extends Controller
{
    /**
     * Display a listing of permits.
     */
    public function index()
    {
        $permits = Auth::user()->isAdmin()
            ? Permit::with(['project.user'])->latest()->paginate(10)
            : Permit::whereHas('project', function ($query) {
                $query->where('user_id', Auth::id());
            })->with('project')->latest()->paginate(10);
            
        return view('permits.index', compact('permits'));
    }

    /**
     * Show the form for creating a new permit.
     */
    public function create(Request $request)
    {
        $project = null;
        
        if ($request->has('project_id')) {
            $project = Project::findOrFail($request->project_id);
            $this->authorize('update', $project);
        } else {
            $projects = Auth::user()->isAdmin()
                ? Project::all()
                : Auth::user()->projects;
        }
        
        return Auth::user()->isAdmin() 
            ? view('layouts.admin.permits.create', compact('project', 'projects'))
            : view('layouts.client.permits.create', compact('project', 'projects'));
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
            'submission_date' => 'required|date',
            'expiration_date' => 'nullable|date|after:submission_date',
            'fee_amount' => 'nullable|numeric',
            'fee_paid' => 'boolean',
            'documents.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
        ]);
        
        $project = Project::findOrFail($validated['project_id']);
        $this->authorize('update', $project);
        
        // Generate a unique permit number
        $validated['permit_number'] = 'PER-' . now()->format('Ymd') . '-' . strtoupper(substr(uniqid(), -5));
        $validated['status'] = 'Pending';
        
        $permit = $project->permits()->create($validated);
        
        // Handle document uploads
        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $file) {
                $path = $file->store('permits/' . $permit->id, 'public');
                
                $permit->documents()->create([
                    'name' => $file->getClientOriginalName(),
                    'file_path' => $path,
                    'file_type' => $file->getClientMimeType(),
                    'file_size' => $file->getSize(),
                ]);
            }
        }
        
        // Create notification for permit creation
        Notification::create([
            'user_id' => $project->user_id,
            'permit_id' => $permit->id,
            'title' => 'New Permit Created',
            'message' => "A new permit ({$permit->permit_number}) has been created for project: {$project->name}",
            'type' => 'status_change',
        ]);
        
        return redirect()->route(Auth::user()->isAdmin() ? 'admin.permits.show' : 'client.permits.show', $permit)
            ->with('success', 'Permit created successfully.');
    }

    /**
     * Display the specified permit.
     */
    public function show(Permit $permit)
    {
        $this->authorize('view', $permit);
        
        $permit->load(['project.user', 'documents', 'comments.user']);
        
        return Auth::user()->isAdmin() 
            ? view('layouts.admin.permits.show', compact('permit'))
            : view('layouts.client.permits.show', compact('permit'));
    }

    /**
     * Show the form for editing the specified permit.
     */
    public function edit(Permit $permit)
    {
        $this->authorize('update', $permit);
        
        return Auth::user()->isAdmin() 
            ? view('layouts.admin.permits.edit', compact('permit'))
            : view('layouts.client.permits.edit', compact('permit'));
    }

    /**
     * Update the specified permit in storage.
     */
    public function update(Request $request, Permit $permit)
    {
        $this->authorize('update', $permit);
        
        $validated = $request->validate([
            'type' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:Pending,In Review,Approved,Rejected',
            'submission_date' => 'required|date',
            'approved_date' => 'nullable|date|after_or_equal:submission_date',
            'expiration_date' => 'nullable|date|after:submission_date',
            'fee_amount' => 'nullable|numeric',
            'fee_paid' => 'boolean',
            'documents.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
        ]);
        
        $oldStatus = $permit->status;
        $permit->update($validated);
        
        // Handle document uploads
        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $file) {
                $path = $file->store('permits/' . $permit->id, 'public');
                
                $permit->documents()->create([
                    'name' => $file->getClientOriginalName(),
                    'file_path' => $path,
                    'file_type' => $file->getClientMimeType(),
                    'file_size' => $file->getSize(),
                ]);
            }
        }
        
        // Create notification for status change
        if ($oldStatus !== $validated['status']) {
            Notification::create([
                'user_id' => $permit->project->user_id,
                'permit_id' => $permit->id,
                'title' => 'Permit Status Changed',
                'message' => "Status for permit {$permit->permit_number} changed from {$oldStatus} to {$validated['status']}",
                'type' => 'status_change',
            ]);
        }
        
        // Add approval date if status changed to Approved
        if ($validated['status'] === 'Approved' && $oldStatus !== 'Approved') {
            $permit->update(['approved_date' => now()]);
        }
        
        return redirect()->route(Auth::user()->isAdmin() ? 'admin.permits.show' : 'client.permits.show', $permit)
            ->with('success', 'Permit updated successfully.');
    }

    /**
     * Remove the specified permit from storage.
     */
    public function destroy(Permit $permit)
    {
        $this->authorize('delete', $permit);
        
        // Delete all associated documents
        foreach ($permit->documents as $document) {
            Storage::disk('public')->delete($document->file_path);
        }
        
        $permit->delete();
        
        return redirect()->route(Auth::user()->isAdmin() ? 'admin.permits.index' : 'client.permits.index')
            ->with('success', 'Permit deleted successfully.');
    }
    
    /**
     * Add a comment to a permit.
     */
    public function addComment(Request $request, Permit $permit)
    {
        $this->authorize('view', $permit);
        
        $validated = $request->validate([
            'content' => 'required|string',
        ]);
        
        $comment = new Comment([
            'user_id' => Auth::id(),
            'content' => $validated['content'],
            'is_admin_comment' => Auth::user()->isAdmin(),
            'permit_id' => $permit->id, // For backward compatibility
        ]);
        
        $permit->comments()->save($comment);
        
        // Create notification for comment
        if ($permit->project->user_id !== Auth::id()) {
            Notification::create([
                'user_id' => $permit->project->user_id,
                'permit_id' => $permit->id,
                'title' => 'New Comment on Permit',
                'message' => "A new comment has been added to permit {$permit->permit_number} by " . Auth::user()->name,
                'type' => 'comment',
            ]);
        }
        
        return redirect()->route(Auth::user()->isAdmin() ? 'admin.permits.show' : 'client.permits.show', $permit)
            ->with('success', 'Comment added successfully.');
    }
    
    /**
     * Delete a document from a permit.
     */
    public function deleteDocument(Document $document)
    {
        $permit = $document->permit;
        $this->authorize('update', $permit);
        
        Storage::disk('public')->delete($document->file_path);
        $document->delete();
        
        return redirect()->route(Auth::user()->isAdmin() ? 'admin.permits.show' : 'client.permits.show', $permit)
            ->with('success', 'Document deleted successfully.');
    }
    
    /**
     * Download a document.
     */
    public function downloadDocument(Document $document)
    {
        $permit = $document->permit;
        $this->authorize('view', $permit);
        
        return Storage::disk('public')->download($document->file_path, $document->name);
    }
    
    /**
     * Update the status of a permit.
     */
    public function updateStatus(Request $request, Permit $permit)
    {
        $this->authorize('update', $permit);
        
        $validated = $request->validate([
            'status' => 'required|in:Pending,In Review,Approved,Rejected',
        ]);
        
        $oldStatus = $permit->status;
        $permit->update($validated);
        
        // Add approval date if status changed to Approved
        if ($validated['status'] === 'Approved' && $oldStatus !== 'Approved') {
            $permit->update(['approved_date' => now()]);
        }
        
        // Create notification for status change
        Notification::create([
            'user_id' => $permit->project->user_id,
            'permit_id' => $permit->id,
            'title' => 'Permit Status Changed',
            'message' => "Status for permit {$permit->permit_number} changed from {$oldStatus} to {$validated['status']}",
            'type' => 'status_change',
        ]);
        
        return redirect()->route(Auth::user()->isAdmin() ? 'admin.permits.show' : 'client.permits.show', $permit)
            ->with('success', 'Permit status updated successfully.');
    }
} 