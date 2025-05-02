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
     */
    public function updateStatus(Request $request, Permit $permit)
    {
        $validated = $request->validate([
            'status' => 'required|in:Pending,In Review,Approved,Rejected',
            'admin_notes' => 'nullable|string',
            'expiration_date' => 'nullable|date|after:today',
        ]);

        $oldStatus = $permit->status;
        $permit->status = $validated['status'];
        $permit->admin_notes = $validated['admin_notes'];
        
        if ($validated['status'] === 'Approved') {
            $permit->approval_date = now();
            $permit->expiration_date = $validated['expiration_date'] ?? now()->addYear();
        }
        
        $permit->save();
        
        // Create notification for the contractor
        Notification::create([
            'user_id' => $permit->project->user_id,
            'permit_id' => $permit->id,
            'title' => 'Permit Status Updated',
            'message' => "Your permit {$permit->permit_number} status has been updated from {$oldStatus} to {$permit->status}.",
            'type' => 'permit_status',
        ]);
        
        return redirect()->route('admin.permits.show', $permit)
            ->with('success', "Permit status updated to {$permit->status} successfully.");
    }

    /**
     * Add a comment to a permit.
     */
    public function addComment(Request $request, Permit $permit)
    {
        $validated = $request->validate([
            'content' => 'required|string',
        ]);
        
        $comment = $permit->comments()->create([
            'user_id' => Auth::id(),
            'content' => $validated['content'],
        ]);
        
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
        $pendingCount = Permit::where('status', 'Pending')->count();
        $inReviewCount = Permit::where('status', 'In Review')->count();
        $approvedCount = Permit::where('status', 'Approved')->count();
        $rejectedCount = Permit::where('status', 'Rejected')->count();
        
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
        
        return response()->json([
            'counts' => [
                'pending' => $pendingCount,
                'in_review' => $inReviewCount,
                'approved' => $approvedCount,
                'rejected' => $rejectedCount,
                'total' => $pendingCount + $inReviewCount + $approvedCount + $rejectedCount
            ],
            'recent' => $recentPermits
        ]);
    }
} 