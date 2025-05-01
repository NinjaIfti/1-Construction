<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use App\Models\Permit;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContractorController extends Controller
{
    /**
     * Display a listing of contractors
     */
    public function index()
    {
        $contractors = User::where('role', 'contractor')->get();
        return view('layouts.admin.contractors.index', compact('contractors'));
    }

    /**
     * Display the specified contractor details
     */
    public function show(User $contractor)
    {
        return view('layouts.admin.contractors.show', compact('contractor'));
    }

    /**
     * Get contractors for the admin dashboard
     */
    public function getDashboardContractors()
    {
        $contractors = User::where('role', 'contractor')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
            
        return response()->json($contractors);
    }

    /**
     * Show the contractor dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $user = Auth::user();
        
        // Get dashboard statistics
        $activeProjects = Project::where('user_id', $user->id)
            ->where('status', '!=', 'completed')
            ->count();
            
        $completedProjects = Project::where('user_id', $user->id)
            ->where('status', 'completed')
            ->count();
            
        $pendingApprovals = Permit::whereHas('project', function($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->whereIn('status', ['submitted', 'under_review'])
            ->count();
            
        // Get recent activities
        $recentActivities = $this->getRecentActivities($user->id);
        
        return view('layouts.client.dashboard', compact(
            'activeProjects', 
            'completedProjects', 
            'pendingApprovals',
            'recentActivities'
        ));
    }
    
    /**
     * Get the recent activities for the user.
     *
     * @param int $userId
     * @return array
     */
    private function getRecentActivities($userId)
    {
        // Get recent permit status updates
        $permitActivities = Permit::whereHas('project', function($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->orderBy('updated_at', 'desc')
            ->take(3)
            ->get()
            ->map(function($permit) {
                return [
                    'message' => $permit->name . ' permit status updated to ' . ucfirst($permit->status),
                    'date' => $permit->updated_at->format('M d')
                ];
            });
            
        // Get recent document uploads
        $documentActivities = Document::whereHas('permit.project', function($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get()
            ->map(function($document) {
                return [
                    'message' => $document->name . ' document uploaded',
                    'date' => $document->created_at->format('M d')
                ];
            });
            
        // Merge and sort activities
        $activities = $permitActivities->concat($documentActivities)
            ->sortByDesc(function($activity) {
                return strtotime($activity['date']);
            })
            ->take(4)
            ->values()
            ->toArray();
            
        return $activities;
    }
} 