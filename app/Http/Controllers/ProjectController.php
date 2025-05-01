<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Permit;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ProjectController extends Controller
{
    /**
     * Display a listing of the projects.
     */
    public function index()
    {
        $projects = Auth::user()->projects()
            ->withCount(['permits', 'tasks'])
            ->latest()
            ->paginate(10);
            
        return view('layouts.client.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new project.
     */
    public function create()
    {
        return view('layouts.client.projects.create');
    }

    /**
     * Store a newly created project in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'project_type' => 'required|string|in:residential,commercial,industrial,infrastructure,mixed_use',
            'status' => 'required|string|in:planning,in_progress,on_hold,completed',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'zip' => 'required|string|max:20',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'budget' => 'nullable|numeric|min:0',
            'contractor_license' => 'nullable|string|max:255',
            'site_contact_name' => 'nullable|string|max:255',
            'site_contact_phone' => 'nullable|string|max:255',
        ]);
        
        $project = Auth::user()->projects()->create($validated);
        
        return redirect()->route('projects.show', $project)
            ->with('success', 'Project created successfully.');
    }

    /**
     * Display the specified project.
     */
    public function show(Project $project)
    {
        $this->authorize('view', $project);
        
        $permits = $project->permits()->latest()->get();
        $tasks = $project->tasks()->latest()->get();
        
        $permits_count = $permits->count();
        $tasks_count = $tasks->count();
        $completed_tasks_count = $tasks->where('status', 'completed')->count();
        $approved_permits_count = $permits->where('status', 'Approved')->count();
        
        return view('layouts.client.projects.show', compact(
            'project', 
            'permits', 
            'tasks',
            'permits_count',
            'tasks_count',
            'completed_tasks_count',
            'approved_permits_count'
        ));
    }

    /**
     * Show the form for editing the specified project.
     */
    public function edit(Project $project)
    {
        $this->authorize('update', $project);
        
        return view('layouts.client.projects.edit', compact('project'));
    }

    /**
     * Update the specified project in storage.
     */
    public function update(Request $request, Project $project)
    {
        $this->authorize('update', $project);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'project_type' => 'required|string|in:residential,commercial,industrial,infrastructure,mixed_use',
            'status' => 'required|string|in:planning,in_progress,on_hold,completed',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'zip' => 'required|string|max:20',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'budget' => 'nullable|numeric|min:0',
            'contractor_license' => 'nullable|string|max:255',
            'site_contact_name' => 'nullable|string|max:255',
            'site_contact_phone' => 'nullable|string|max:255',
        ]);
        
        $project->update($validated);
        
        return redirect()->route('projects.show', $project)
            ->with('success', 'Project updated successfully.');
    }

    /**
     * Remove the specified project from storage.
     */
    public function destroy(Project $project)
    {
        $this->authorize('delete', $project);
        
        $project->delete();
        
        return redirect()->route('projects.index')
            ->with('success', 'Project deleted successfully.');
    }
    
    /**
     * Display the project dashboard.
     */
    public function dashboard(Project $project)
    {
        $this->authorize('view', $project);
        
        // Project statistics
        $permits_count = $project->permits()->count();
        $approved_permits_count = $project->permits()->where('status', 'Approved')->count();
        $pending_tasks_count = $project->tasks()->whereIn('status', ['pending', 'in_progress'])->count();
        
        // Calculate days remaining
        $days_remaining = 0;
        if ($project->end_date) {
            $end_date = Carbon::parse($project->end_date);
            if ($end_date->isFuture()) {
                $days_remaining = Carbon::now()->diffInDays($end_date);
            }
        }
        
        // Calculate project duration and progress
        $project_duration = 0;
        $project_progress = 0;
        
        if ($project->start_date && $project->end_date) {
            $start_date = Carbon::parse($project->start_date);
            $end_date = Carbon::parse($project->end_date);
            $project_duration = $start_date->diffInDays($end_date);
            
            if ($project_duration > 0) {
                $elapsed = $start_date->isPast() ? $start_date->diffInDays(Carbon::now()) : 0;
                $project_progress = min(100, round(($elapsed / $project_duration) * 100));
            }
        }
        
        // Get recent activities
        $recent_activities = $this->getProjectActivities($project->id);
        
        // Get recent permits and upcoming tasks
        $recent_permits = $project->permits()->latest()->take(3)->get();
        $upcoming_tasks = $project->tasks()
            ->whereIn('status', ['pending', 'in_progress'])
            ->orderBy('due_date')
            ->take(3)
            ->get();
        
        return view('layouts.client.projects.dashboard', compact(
            'project',
            'permits_count',
            'approved_permits_count',
            'pending_tasks_count',
            'days_remaining',
            'project_duration',
            'project_progress',
            'recent_activities',
            'recent_permits',
            'upcoming_tasks'
        ));
    }
    
    /**
     * Get recent activities for a project.
     *
     * @param int $projectId
     * @return array
     */
    private function getProjectActivities($projectId)
    {
        // Get permit activities
        $permitActivities = Permit::where('project_id', $projectId)
            ->orderBy('updated_at', 'desc')
            ->take(3)
            ->get()
            ->map(function($permit) {
                return [
                    'message' => 'Permit status updated to ' . $permit->status,
                    'date' => $permit->updated_at->format('M d, Y')
                ];
            });
            
        // Get task activities
        $taskActivities = Task::where('project_id', $projectId)
            ->orderBy('updated_at', 'desc')
            ->take(3)
            ->get()
            ->map(function($task) {
                return [
                    'message' => 'Task "' . $task->title . '" status updated to ' . ucfirst($task->status),
                    'date' => $task->updated_at->format('M d, Y')
                ];
            });
            
        // Merge and sort activities
        $activities = $permitActivities->concat($taskActivities)
            ->sortByDesc(function($activity) {
                return strtotime($activity['date']);
            })
            ->take(5)
            ->values()
            ->toArray();
            
        return $activities;
    }
} 