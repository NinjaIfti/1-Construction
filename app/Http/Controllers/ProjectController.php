<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the projects.
     */
    public function index()
    {
        $projects = Auth::user()->isAdmin() 
            ? Project::with('user')->latest()->paginate(10)
            : Auth::user()->projects()->latest()->paginate(10);
            
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
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'zip' => 'required|string|max:20',
            'project_type' => 'required|string|max:100',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
            'status' => 'required|in:Planning,Active,On Hold,Completed',
            'contractor_id' => 'nullable|exists:users,id',
        ]);
        
        $project = new Project($validated);
        $project->user_id = Auth::id();
        
        // If contractor_id is not provided, set the authenticated user as both owner and contractor
        if (!isset($validated['contractor_id']) && Auth::user()->isContractor()) {
            $project->contractor_id = Auth::id();
        }
        
        $project->save();
        
        return redirect()->route('projects.show', $project)
            ->with('success', 'Project created successfully.');
    }

    /**
     * Display the specified project.
     */
    public function show(Project $project)
    {
        $this->authorize('view', $project);
        
        $project->load(['permits']);
        
        $permits = $project->permits()->latest()->get();
        $tasks = collect();
        
        return view('layouts.client.projects.show', compact('project', 'permits', 'tasks'));
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
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'zip' => 'required|string|max:20',
            'project_type' => 'required|string|max:100',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
            'status' => 'required|in:Planning,Active,On Hold,Completed',
            'contractor_id' => 'nullable|exists:users,id',
        ]);
        
        // Only update contractor_id if it's provided and different
        if (isset($validated['contractor_id']) && $validated['contractor_id'] != $project->contractor_id) {
            $project->contractor_id = $validated['contractor_id'];
        }
        
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
        
        $project->load(['permits']);
        
        $permitsByStatus = [
            'Pending' => $project->permits()->where('status', 'Pending')->count(),
            'In Review' => $project->permits()->where('status', 'In Review')->count(),
            'Approved' => $project->permits()->where('status', 'Approved')->count(),
            'Rejected' => $project->permits()->where('status', 'Rejected')->count(),
        ];
        
        $tasksByStatus = [
            'Pending' => 0,
            'In Progress' => 0,
            'Completed' => 0,
        ];
        
        $recentPermits = $project->permits()->latest()->take(5)->get();
        $recentTasks = collect();
        
        return view('layouts.client.projects.dashboard', compact(
            'project', 
            'permitsByStatus', 
            'tasksByStatus', 
            'recentPermits', 
            'recentTasks'
        ));
    }
} 