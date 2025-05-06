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
        $contractors = User::where('role', 'contractor')->get();
        return view('layouts.admin.projects.create', compact('contractors'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'contractor_id' => 'required|exists:users,id',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
            'budget' => 'required|numeric|min:0',
            'status' => 'required|in:pending,in_progress,completed'
        ]);

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
            'contractor_id' => 'required|exists:users,id',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
            'budget' => 'required|numeric|min:0',
            'status' => 'required|in:pending,in_progress,completed'
        ]);

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
} 