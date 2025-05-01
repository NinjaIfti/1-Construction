@extends('layouts.client.dashboard')

@section('content')
<div id="project-dashboard-content">
    <div class="flex justify-between items-center mb-4">
        <div>
            <h2 class="text-2xl font-bold">{{ $project->name }} Dashboard</h2>
            <p class="text-gray-600">{{ ucfirst($project->project_type) }} Project | {{ ucfirst(str_replace('_', ' ', $project->status)) }}</p>
        </div>
        <div>
            <a href="{{ route('projects.edit', $project) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white py-2 px-4 rounded mr-2">
                <i class="fas fa-edit mr-1"></i> Edit
            </a>
            <a href="{{ route('projects.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 py-2 px-4 rounded">
                <i class="fas fa-arrow-left mr-1"></i> Back
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <!-- Project Overview -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white p-4 rounded shadow-md flex items-center">
            <div class="rounded-full bg-blue-100 p-3 mr-3">
                <i class="fas fa-file-alt text-blue-500"></i>
            </div>
            <div>
                <div class="text-xl font-bold">{{ $permits_count }}</div>
                <div class="text-sm text-gray-600">Total Permits</div>
            </div>
        </div>
        <div class="bg-white p-4 rounded shadow-md flex items-center">
            <div class="rounded-full bg-green-100 p-3 mr-3">
                <i class="fas fa-check-circle text-green-500"></i>
            </div>
            <div>
                <div class="text-xl font-bold">{{ $approved_permits_count }}</div>
                <div class="text-sm text-gray-600">Approved Permits</div>
            </div>
        </div>
        <div class="bg-white p-4 rounded shadow-md flex items-center">
            <div class="rounded-full bg-yellow-100 p-3 mr-3">
                <i class="fas fa-tasks text-yellow-500"></i>
            </div>
            <div>
                <div class="text-xl font-bold">{{ $pending_tasks_count }}</div>
                <div class="text-sm text-gray-600">Pending Tasks</div>
            </div>
        </div>
        <div class="bg-white p-4 rounded shadow-md flex items-center">
            <div class="rounded-full bg-purple-100 p-3 mr-3">
                <i class="fas fa-calendar-alt text-purple-500"></i>
            </div>
            <div>
                <div class="text-xl font-bold">{{ $days_remaining }}</div>
                <div class="text-sm text-gray-600">Days Remaining</div>
            </div>
        </div>
    </div>

    <!-- Project Timeline and Details -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <!-- Project Timeline -->
        <div class="md:col-span-2 bg-white rounded-lg shadow-md p-4">
            <h3 class="text-lg font-semibold mb-3">Project Timeline</h3>
            
            <div class="flex items-center mb-4">
                <div class="w-full bg-gray-200 rounded-full h-2.5">
                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $project_progress }}%"></div>
                </div>
                <span class="ml-2 text-sm font-medium">{{ $project_progress }}%</span>
            </div>
            
            <div class="flex justify-between text-sm text-gray-600 mb-6">
                <div>
                    <div class="font-medium">Start Date</div>
                    <div>{{ $project->start_date ? date('M d, Y', strtotime($project->start_date)) : 'Not set' }}</div>
                </div>
                <div class="text-center">
                    <div class="font-medium">Duration</div>
                    <div>{{ $project_duration }} days</div>
                </div>
                <div class="text-right">
                    <div class="font-medium">End Date</div>
                    <div>{{ $project->end_date ? date('M d, Y', strtotime($project->end_date)) : 'Not set' }}</div>
                </div>
            </div>
            
            <h4 class="font-medium mb-2">Recent Activity</h4>
            <div class="space-y-3">
                @forelse($recent_activities as $activity)
                    <div class="border-l-2 border-blue-500 pl-3 py-1">
                        <div class="text-sm">{{ $activity['message'] }}</div>
                        <div class="text-xs text-gray-500">{{ $activity['date'] }}</div>
                    </div>
                @empty
                    <p class="text-gray-500 text-sm">No recent activity for this project.</p>
                @endforelse
            </div>
        </div>
        
        <!-- Project Details -->
        <div class="bg-white rounded-lg shadow-md p-4">
            <h3 class="text-lg font-semibold mb-3">Project Details</h3>
            
            <div class="mb-4">
                <h4 class="font-medium mb-1">Location</h4>
                <p class="text-sm text-gray-600">
                    {{ $project->address }}<br>
                    {{ $project->city }}, {{ $project->state }} {{ $project->zip }}
                </p>
            </div>
            
            <div class="mb-4">
                <h4 class="font-medium mb-1">Budget</h4>
                <p class="text-sm text-gray-600">{{ $project->budget ? '$'.number_format($project->budget, 2) : 'Not specified' }}</p>
            </div>
            
            <div class="mb-4">
                <h4 class="font-medium mb-1">License Numbers</h4>
                <p class="text-sm text-gray-600">{{ $project->contractor_license ?? 'Not specified' }}</p>
            </div>
            
            <div>
                <h4 class="font-medium mb-1">Site Contact</h4>
                <p class="text-sm text-gray-600">
                    {{ $project->site_contact_name ?? 'Not specified' }}<br>
                    {{ $project->site_contact_phone ?? 'No phone provided' }}
                </p>
            </div>
            
            <div class="mt-4 pt-4 border-t">
                <a href="{{ route('projects.show', $project) }}" class="text-blue-500 hover:text-blue-700">
                    <i class="fas fa-info-circle mr-1"></i> View Full Project Details
                </a>
            </div>
        </div>
    </div>
    
    <!-- Permit Status and Tasks -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Permit Status -->
        <div class="bg-white rounded-lg shadow-md p-4">
            <div class="flex justify-between items-center mb-3">
                <h3 class="text-lg font-semibold">Permit Status</h3>
                <a href="{{ route('permits.create', ['project_id' => $project->id]) }}" class="text-sm text-blue-500 hover:text-blue-700">
                    <i class="fas fa-plus mr-1"></i> Add New
                </a>
            </div>
            
            <div class="space-y-3">
                @forelse($recent_permits as $permit)
                    <div class="border rounded p-3 flex justify-between items-center">
                        <div>
                            <div class="font-medium">{{ $permit->type }}</div>
                            <div class="text-xs text-gray-500">{{ $permit->permit_number }}</div>
                        </div>
                        <div class="flex items-center">
                            <span class="px-2 py-1 text-xs rounded-full 
                                @if($permit->status == 'Pending') bg-yellow-100 text-yellow-800
                                @elseif($permit->status == 'In Review') bg-blue-100 text-blue-800
                                @elseif($permit->status == 'Approved') bg-green-100 text-green-800
                                @elseif($permit->status == 'Rejected') bg-red-100 text-red-800
                                @endif mr-2">
                                {{ $permit->status }}
                            </span>
                            <a href="{{ route('permits.show', $permit) }}" class="text-blue-500 hover:text-blue-700">
                                <i class="fas fa-eye"></i>
                            </a>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 text-sm">No permits created for this project yet.</p>
                @endforelse
            </div>
            
            @if(count($recent_permits) > 0 && $permits_count > count($recent_permits))
                <div class="mt-3 text-center">
                    <a href="{{ route('projects.show', ['project' => $project->id, 'tab' => 'permits']) }}" class="text-sm text-blue-500 hover:text-blue-700">
                        View All Permits
                    </a>
                </div>
            @endif
        </div>
        
        <!-- Upcoming Tasks -->
        <div class="bg-white rounded-lg shadow-md p-4">
            <div class="flex justify-between items-center mb-3">
                <h3 class="text-lg font-semibold">Upcoming Tasks</h3>
                <a href="{{ route('tasks.create', ['project_id' => $project->id]) }}" class="text-sm text-blue-500 hover:text-blue-700">
                    <i class="fas fa-plus mr-1"></i> Add New
                </a>
            </div>
            
            <div class="space-y-3">
                @forelse($upcoming_tasks as $task)
                    <div class="border rounded p-3 
                        @if($task->priority == 'high') border-red-300
                        @elseif($task->priority == 'medium') border-yellow-300
                        @else border-green-300
                        @endif">
                        <div class="flex justify-between items-start">
                            <div>
                                <div class="font-medium">{{ $task->title }}</div>
                                <div class="text-xs text-gray-500">Due: {{ $task->due_date ? date('M d, Y', strtotime($task->due_date)) : 'No deadline' }}</div>
                            </div>
                            <div class="flex items-center">
                                <span class="px-2 py-1 text-xs rounded-full
                                    @if($task->priority == 'high') bg-red-100 text-red-800
                                    @elseif($task->priority == 'medium') bg-yellow-100 text-yellow-800
                                    @elseif($task->priority == 'low') bg-green-100 text-green-800
                                    @endif mr-2">
                                    {{ ucfirst($task->priority) }}
                                </span>
                                <a href="{{ route('tasks.show', $task) }}" class="text-blue-500 hover:text-blue-700">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 text-sm">No upcoming tasks for this project.</p>
                @endforelse
            </div>
            
            @if(count($upcoming_tasks) > 0 && $pending_tasks_count > count($upcoming_tasks))
                <div class="mt-3 text-center">
                    <a href="{{ route('projects.show', ['project' => $project->id, 'tab' => 'tasks']) }}" class="text-sm text-blue-500 hover:text-blue-700">
                        View All Tasks
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection 