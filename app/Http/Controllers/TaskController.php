<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use App\Models\User;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the user's tasks.
     * 
     * When no project is specified, show all tasks for the authenticated user
     */
    public function index(Project $project = null)
    {
        if ($project) {
            // Project-specific tasks
            $this->authorize('view', $project);
            $tasks = $project->tasks()->latest()->get();
            return view('layouts.client.tasks.index', compact('project', 'tasks'));
        } else {
            // All tasks for the authenticated user
            $user = Auth::user();
            $tasks = $user->assignedTasks()
                ->with('project')
                ->latest()
                ->get();
            return view('layouts.client.tasks.my_tasks', compact('tasks'));
        }
    }

    /**
     * Show the form for creating a new task.
     */
    public function create(Project $project)
    {
        $this->authorize('update', $project);
        
        return view('layouts.client.tasks.create', compact('project'));
    }

    /**
     * Store a newly created task in storage.
     */
    public function store(Request $request, Project $project)
    {
        $this->authorize('update', $project);
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'priority' => 'required|in:Low,Medium,High',
            'status' => 'required|in:Pending,In Progress,Completed',
            'assigned_to' => 'nullable|exists:users,id',
        ]);
        
        $task = $project->tasks()->create($validated);
        
        // Create notification for this task
        if ($task->assigned_to) {
            $assignedUser = User::find($task->assigned_to);
            NotificationService::notify(
                $assignedUser,
                "New task assigned: {$task->title}",
                $task,
                'task',
                route('tasks.show', $task)
            );
        }
        
        return redirect()->route('projects.tasks.index', $project)
            ->with('success', 'Task created successfully.');
    }

    /**
     * Display the specified task.
     */
    public function show(Task $task)
    {
        $this->authorize('view', $task->project);
        
        return view('layouts.client.tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified task.
     */
    public function edit(Task $task)
    {
        $this->authorize('update', $task->project);
        
        return view('layouts.client.tasks.edit', compact('task'));
    }

    /**
     * Update the specified task in storage.
     */
    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task->project);
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'priority' => 'required|in:Low,Medium,High',
            'status' => 'required|in:Pending,In Progress,Completed',
            'assigned_to' => 'nullable|exists:users,id',
        ]);
        
        $oldStatus = $task->status;
        $task->update($validated);
        
        // Create notification if status changed
        if ($oldStatus != $task->status) {
            NotificationService::notify(
                $task->project->user,
                "Task '{$task->title}' status changed to {$task->status}",
                $task,
                'task',
                route('tasks.show', $task)
            );
        }
        
        return redirect()->route('tasks.show', $task)
            ->with('success', 'Task updated successfully.');
    }

    /**
     * Remove the specified task from storage.
     */
    public function destroy(Task $task)
    {
        $this->authorize('delete', $task->project);
        
        $project = $task->project;
        $task->delete();
        
        return redirect()->route('projects.tasks.index', $project)
            ->with('success', 'Task deleted successfully.');
    }
    
    /**
     * Get tasks for API.
     */
    public function getProjectTasks(Project $project)
    {
        $this->authorize('view', $project);
        
        $tasks = $project->tasks()
            ->orderBy('due_date')
            ->get()
            ->map(function($task) {
                return [
                    'id' => $task->id,
                    'title' => $task->title,
                    'status' => $task->status,
                    'priority' => $task->priority,
                    'due_date' => $task->due_date ? $task->due_date->format('M d, Y') : null,
                    'url' => route('tasks.show', $task),
                    'assigned_to' => $task->assigned_to ? [
                        'id' => $task->assignedUser->id,
                        'name' => $task->assignedUser->name
                    ] : null
                ];
            });
            
        return response()->json($tasks);
    }
} 