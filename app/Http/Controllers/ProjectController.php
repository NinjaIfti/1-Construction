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
        
        $project->load(['permits', 'tasks']);
        
        $permits = $project->permits()->latest()->get();
        $tasks = $project->tasks()->latest()->get();
        
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
        
        $project->load(['permits', 'tasks']);
        
        $permitsByStatus = [
            'Pending' => $project->permits()->where('status', 'Pending')->count(),
            'In Review' => $project->permits()->where('status', 'In Review')->count(),
            'Approved' => $project->permits()->where('status', 'Approved')->count(),
            'Rejected' => $project->permits()->where('status', 'Rejected')->count(),
        ];
        
        $tasksByStatus = [
            'Pending' => $project->tasks()->where('status', 'Pending')->count(),
            'In Progress' => $project->tasks()->where('status', 'In Progress')->count(),
            'Completed' => $project->tasks()->where('status', 'Completed')->count(),
        ];
        
        $recentPermits = $project->permits()->latest()->take(5)->get();
        $recentTasks = $project->tasks()->latest()->take(5)->get();
        
        return view('layouts.client.projects.dashboard', compact(
            'project', 
            'permitsByStatus', 
            'tasksByStatus', 
            'recentPermits', 
            'recentTasks'
        ));
    }
} 