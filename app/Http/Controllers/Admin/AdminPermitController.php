<?php

namespace App\Http\Controllers\Admin;

use App\Models\Permit;
use App\Models\User;
use App\Models\Project;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use App\Models\Comment;

class AdminPermitController extends Controller
{
    /**
     * Display a listing of the permits organized by contractor.
     */
    public function index()
    {
        $contractors = User::where('role', 'contractor')
            ->whereHas('projects.permits')
            ->with(['projects.permits' => function($query) {
                $query->latest();
            }])
            ->get();

        // Count permits by status
        $pendingCount = Permit::where('status', 'Pending')->count();
        $inReviewCount = Permit::where('status', 'In Review')->count();
        $approvedCount = Permit::where('status', 'Approved')->count();
        $rejectedCount = Permit::where('status', 'Rejected')->count();
        
        return view('layouts.admin.permits.index', compact(
            'contractors', 
            'pendingCount', 
            'inReviewCount', 
            'approvedCount', 
            'rejectedCount'
        ));
    }

    /**
     * Display permits for a specific contractor.
     */
    public function contractorPermits(User $contractor)
    {
        if ($contractor->role !== 'contractor') {
            return redirect()->route('admin.permits.index')
                ->with('error', 'Selected user is not a contractor.');
        }

        $permits = Permit::whereHas('project', function($query) use ($contractor) {
                $query->where('user_id', $contractor->id);
            })
            ->with(['project', 'documents'])
            ->latest()
            ->paginate(10);

        return view('layouts.admin.permits.contractor', compact('contractor', 'permits'));
    }

    /**
     * Display the specified permit.
     */
    public function show(Permit $permit)
    {
        $permit->load(['project.user', 'documents', 'comments.user']);
        
        return view('layouts.admin.permits.show', compact('permit'));
    }

    /**
     * Update the permit status.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Permit  $permit
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateStatus(Request $request, Permit $permit)
    {
        $request->validate([
            'status' => ['required', 'string', Rule::in(['Approved', 'Rejected'])],
            'admin_notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $permit->update([
            'status' => $request->status,
            'admin_notes' => $request->admin_notes,
            'approved_date' => $request->status === 'Approved' ? now() : null,
        ]);

        // Create notification for the client
        $permit->notifications()->create([
            'user_id' => $permit->project->user_id,
            'title' => 'Permit Status Updated',
            'message' => "Your permit #{$permit->permit_number} has been {$request->status}.",
            'type' => 'permit_status',
            'read' => false,
        ]);

        return redirect()->route('admin.permits.show', $permit)
            ->with('success', 'Permit status updated successfully.');
    }

    /**
     * Add a comment to a permit.
     */
    public function addComment(Request $request, Permit $permit)
    {
        $validated = $request->validate([
            'content' => 'required|string',
        ]);
        
        $comment = new Comment([
            'user_id' => Auth::id(),
            'content' => $validated['content'],
            'is_admin_comment' => true,
            'permit_id' => $permit->id, // For backward compatibility
        ]);
        
        $permit->comments()->save($comment);
        
        // Create notification for the contractor
        Notification::create([
            'user_id' => $permit->project->user_id,
            'permit_id' => $permit->id,
            'title' => 'New Comment on Permit',
            'message' => "An admin has added a comment to your permit {$permit->permit_number}",
            'type' => 'comment',
        ]);
        
        return redirect()->route('admin.permits.show', $permit)
            ->with('success', 'Comment added successfully.');
    }

    /**
     * Get dashboard permit statistics.
     */
    public function getDashboardPermits()
    {
        $recentPermits = Permit::with('project.user')
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($permit) {
                return [
                    'id' => $permit->id,
                    'permit_number' => $permit->permit_number,
                    'type' => $permit->type,
                    'status' => $permit->status,
                    'contractor_name' => $permit->project->user->name,
                    'submission_date' => $permit->submission_date->format('M d, Y'),
                ];
            });
        
        return response()->json($recentPermits);
    }

    /**
     * Delete the specified permit.
     *
     * @param  \App\Models\Permit  $permit
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Permit $permit)
    {
        // Store info for notification/redirect
        $permitNumber = $permit->permit_number;
        $projectId = $permit->project_id;
        $userId = $permit->project->user_id;
        
        // Delete associated documents' files
        foreach ($permit->documents as $document) {
            if ($document->file_path && Storage::disk('public')->exists($document->file_path)) {
                Storage::disk('public')->delete($document->file_path);
            }
        }
        
        // Delete associated comments and notifications
        $permit->comments()->delete();
        Notification::where('permit_id', $permit->id)->delete();
        
        // Delete the permit
        $permit->delete();
        
        // Create notification for contractor
        Notification::create([
            'user_id' => $userId,
            'title' => 'Permit Deleted',
            'message' => "Your permit #{$permitNumber} has been deleted by an administrator.",
            'type' => 'permit_deleted',
        ]);
        
        return redirect()->route('admin.permits.index')
            ->with('success', "Permit #{$permitNumber} has been deleted successfully.");
    }
} 