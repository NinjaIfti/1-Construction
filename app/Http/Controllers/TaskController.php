<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of tasks.
     */
    public function index(Request $request)
    {
        $query = Auth::user()->isAdmin()
            ? Task::with(['project', 'user'])
            : Task::where('user_id', Auth::id())
                ->orWhereHas('project', function ($query) {
                    $query->where('user_id', Auth::id());
                })->with(['project', 'user']);
                
        // Filter by status
        if ($request->has('status') && in_array($request->status, ['Pending', 'In Progress', 'Completed'])) {
            $query->where('status', $request->status);
        }
        
        // Filter by priority
        if ($request->has('priority') && in_array($request->priority, ['Low', 'Medium', 'High'])) {
            $query->where('priority', $request->priority);
        }
        
        // Filter by due date
        if ($request->has('due_date')) {
            if ($request->due_date === 'today') {
                $query->whereDate('due_date', now());
            } elseif ($request->due_date === 'overdue') {
                $query->where('status', '!=', 'Completed')
                      ->whereDate('due_date', '<', now());
            } elseif ($request->due_date === 'upcoming') {
                $query->where('status', '!=', 'Completed')
                      ->whereDate('due_date', '>', now())
                      ->whereDate('due_date', '<=', now()->addDays(7));
            }
        }
        
        $tasks = $query->latest()->paginate(10);
        
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new task.
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
        
        $users = User::all();
        
        return view('tasks.create', compact('project', 'projects', 'users'));
    }

    /**
     * Store a newly created task in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:Low,Medium,High',
            'status' => 'required|in:Pending,In Progress,Completed',
            'due_date' => 'required|date',
        ]);
        
        $project = Project::findOrFail($validated['project_id']);
        $this->authorize('update', $project);
        
        $task = Task::create($validated);
        
        if ($validated['status'] === 'Completed') {
            $task->completed_at = now();
            $task->save();
        }
        
        return redirect()->route('tasks.show', $task)
            ->with('success', 'Task created successfully.');
    }

    /**
     * Display the specified task.
     */
    public function show(Task $task)
    {
        $this->authorize('view', $task);
        
        $task->load('project', 'user');
        
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified task.
     */
    public function edit(Task $task)
    {
        $this->authorize('update', $task);
        
        $users = User::all();
        
        return view('tasks.edit', compact('task', 'users'));
    }

    /**
     * Update the specified task in storage.
     */
    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task);
        
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:Low,Medium,High',
            'status' => 'required|in:Pending,In Progress,Completed',
            'due_date' => 'required|date',
        ]);
        
        // Set completed_at timestamp if task is being marked as completed
        if ($validated['status'] === 'Completed' && $task->status !== 'Completed') {
            $validated['completed_at'] = now();
        } elseif ($validated['status'] !== 'Completed') {
            $validated['completed_at'] = null;
        }
        
        $task->update($validated);
        
        return redirect()->route('tasks.show', $task)
            ->with('success', 'Task updated successfully.');
    }

    /**
     * Remove the specified task from storage.
     */
    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);
        
        $task->delete();
        
        return redirect()->route('tasks.index')
            ->with('success', 'Task deleted successfully.');
    }
    
    /**
     * Update the status of a task.
     */
    public function updateStatus(Request $request, Task $task)
    {
        $this->authorize('update', $task);
        
        $validated = $request->validate([
            'status' => 'required|in:Pending,In Progress,Completed',
        ]);
        
        if ($validated['status'] === 'Completed' && $task->status !== 'Completed') {
            $task->update([
                'status' => 'Completed',
                'completed_at' => now(),
            ]);
        } else {
            $task->update([
                'status' => $validated['status'],
                'completed_at' => $validated['status'] === 'Completed' ? $task->completed_at : null,
            ]);
        }
        
        return redirect()->back()
            ->with('success', 'Task status updated successfully.');
    }
    
    /**
     * Display tasks for a specific project.
     */
    public function projectTasks(Project $project)
    {
        $this->authorize('view', $project);
        
        $tasks = $project->tasks()->latest()->paginate(10);
        
        return view('tasks.project_tasks', compact('project', 'tasks'));
    }
    
    /**
     * Display tasks assigned to the current user.
     */
    public function myTasks()
    {
        $tasks = Auth::user()->tasks()->latest()->paginate(10);
        
        return view('tasks.my_tasks', compact('tasks'));
    }
} 