<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::with('contractor');

        // Filter by status
        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Filter by contractor
        if ($request->has('contractor_id')) {
            $query->where('contractor_id', $request->contractor_id);
        }

        $projects = $query->latest()->paginate(10);
        $contractors = User::where('role', 'contractor')->get();

        return view('layouts.admin.projects.index', compact('projects', 'contractors'));
    }

    public function create()
    {
        // Debug: Check the status column definition
        $columnInfo = DB::select("SHOW COLUMNS FROM projects WHERE Field = 'status'");
        \Log::info('Status column definition:', $columnInfo);

        $contractors = User::where('role', 'contractor')->get();
        return view('layouts.admin.projects.create', compact('contractors'));
    }

    public function store(Request $request)
    {
        // Debug: Log all request data
        \Log::info('Project create request data:', $request->all());
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'zip_code' => 'required|string|max:20',
            'contractor_id' => 'required|exists:users,id',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
            'budget' => 'required|numeric|min:0',
            // Remove status validation since we'll set it manually
        ]);

        // Debug: Log validated data
        \Log::info('Project validated data:', $validated);

        // Hardcode the status to a known valid value
        $validated['status'] = 'pending';

        // Use the contractor_id as the user_id so it shows up in the contractor's dashboard
        $validated['user_id'] = $validated['contractor_id'];

        $project = Project::create($validated);

        return redirect()
            ->route('admin.projects.show', $project)
            ->with('success', 'Project created successfully.');
    }

    public function show(Project $project)
    {
        $project->load('contractor');
        return view('layouts.admin.projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        $contractors = User::where('role', 'contractor')->get();
        return view('layouts.admin.projects.edit', compact('project', 'contractors'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'zip_code' => 'required|string|max:20',
            'contractor_id' => 'required|exists:users,id',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
            'budget' => 'required|numeric|min:0',
            'status' => 'required|string'
        ]);

        // Ensure status is one of the allowed values
        $allowedStatuses = ['pending', 'in_progress', 'completed'];
        $validated['status'] = in_array($validated['status'], $allowedStatuses) 
            ? $validated['status'] 
            : 'pending'; // Default to pending if not valid
            
        // Update user_id if contractor_id changed
        if ($project->contractor_id != $validated['contractor_id']) {
            $validated['user_id'] = $validated['contractor_id'];
        }

        $project->update($validated);

        return redirect()
            ->route('admin.projects.show', $project)
            ->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Project deleted successfully.');
    }

    public function approve(Project $project)
    {
        if ($project->status !== 'pending') {
            return back()->with('error', 'Only pending projects can be approved.');
        }

        $project->update(['status' => 'in_progress']);

        return back()->with('success', 'Project approved and marked as in progress.');
    }

    public function complete(Project $project)
    {
        if ($project->status !== 'in_progress') {
            return back()->with('error', 'Only in-progress projects can be marked as completed.');
        }

        $project->update([
            'status' => 'completed',
            'end_date' => now()
        ]);

        return back()->with('success', 'Project marked as completed.');
    }

    /**
     * Get projects data for admin dashboard
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDashboardProjects()
    {
        $counts = [
            'pending' => Project::where('status', 'pending')->count(),
            'in_progress' => Project::where('status', 'in_progress')->count(),
            'completed' => Project::where('status', 'completed')->count(),
            'total' => Project::count()
        ];
        
        $recent = Project::with('contractor')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
            
        return response()->json([
            'counts' => $counts,
            'recent' => $recent
        ]);
    }
} 