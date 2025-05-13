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
                    'date' => $permit->updated_at->format('M d'),
                    'timestamp' => strtotime($permit->updated_at),
                    'type' => 'permit'
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
                    'date' => $document->created_at->format('M d'),
                    'timestamp' => strtotime($document->created_at),
                    'type' => 'document'
                ];
            });
            
        // Get recent project activities
        $projectActivities = Project::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get()
            ->map(function($project) {
                return [
                    'message' => 'Project "' . $project->name . '" ' . ($project->created_at->eq($project->updated_at) ? 'created' : 'updated'),
                    'date' => $project->updated_at->format('M d'),
                    'timestamp' => strtotime($project->updated_at),
                    'type' => 'project'
                ];
            });
            
        // Get recent messages with unread status
        $messageActivities = \App\Models\Message::where(function($query) use ($userId) {
                $query->where('recipient_id', $userId);
            })
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get()
            ->map(function($message) use ($userId) {
                $isUnread = $message->read_at === null;
                return [
                    'message' => ($isUnread ? '[UNREAD] ' : '') . 'Message: ' . $message->subject,
                    'date' => $message->created_at->format('M d'),
                    'timestamp' => strtotime($message->created_at),
                    'type' => $isUnread ? 'unread_message' : 'message',
                    'messageId' => $message->id
                ];
            });
            
        // Merge and sort activities
        $activities = $permitActivities->concat($documentActivities)
            ->concat($projectActivities)
            ->concat($messageActivities)
            ->sortByDesc('timestamp')
            ->take(8)
            ->values()
            ->toArray();
            
        return $activities;
    }

    /**
     * Show the client dashboard with document section active.
     */
    public function documents()
    {
        $user = Auth::user();
        
        // Dashboard statistics for sidebar
        $activeProjects = $user->projects()->where('status', 'active')->count();
        $completedProjects = $user->projects()->where('status', 'completed')->count();
        $pendingApprovals = $user->projects()->where('status', 'pending')->count();
        
        // Get recent activities
        $recentActivities = $this->getRecentActivities($user->id);
        
        // Define the active section for the dashboard
        $activeSection = 'documents';
        
        return view('layouts.client.dashboard', compact('activeProjects', 'completedProjects', 'pendingApprovals', 'recentActivities', 'activeSection'));
    }

    /**
     * Get dashboard statistics for API.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDashboardStats()
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
            
        $totalDocuments = Document::where('user_id', $user->id)->count();
            
        return response()->json([
            'activeProjects' => $activeProjects,
            'completedProjects' => $completedProjects,
            'pendingApprovals' => $pendingApprovals,
            'totalDocuments' => $totalDocuments
        ]);
    }
    
    /**
     * Get dashboard activities for API.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDashboardActivities()
    {
        $user = Auth::user();
        
        // Get recent activities
        $activities = $this->getRecentActivities($user->id);
        
        // Debug log
        \Log::info('Dashboard activities retrieved for user ' . $user->id, [
            'count' => count($activities),
            'activities' => $activities
        ]);
        
        // If no activities found, provide fallback sample activities
        if (empty($activities)) {
            $activities = [
                [
                    'message' => 'Welcome to your dashboard! Your activity will appear here.',
                    'date' => now()->format('M d'),
                    'timestamp' => time(),
                    'type' => 'system'
                ],
                [
                    'message' => '[UNREAD] Message: New project approval required',
                    'date' => now()->subDays(1)->format('M d'),
                    'timestamp' => now()->subDays(1)->timestamp,
                    'type' => 'unread_message',
                    'messageId' => 1
                ],
                [
                    'message' => 'Project "Sample Home Build" created',
                    'date' => now()->subDays(2)->format('M d'),
                    'timestamp' => now()->subDays(2)->timestamp,
                    'type' => 'project'
                ],
                [
                    'message' => 'Building permit status updated to Approved',
                    'date' => now()->subDays(3)->format('M d'),
                    'timestamp' => now()->subDays(3)->timestamp,
                    'type' => 'permit'
                ]
            ];
        }
        
        return response()->json($activities);
    }
} 