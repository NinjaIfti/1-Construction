@extends('layouts.client.dashboard')

@section('content')
<div id="show-project-content">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">{{ $project->name }}</h2>
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

    <!-- Project Information -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex justify-between items-start">
            <div>
                <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold 
                    @if($project->status == 'planning') bg-blue-100 text-blue-800
                    @elseif($project->status == 'in_progress') bg-yellow-100 text-yellow-800
                    @elseif($project->status == 'on_hold') bg-red-100 text-red-800
                    @elseif($project->status == 'completed') bg-green-100 text-green-800
                    @endif mr-2">
                    {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                </span>
                <span class="text-gray-600">{{ ucfirst($project->project_type) }}</span>
            </div>
            <div class="text-right">
                <div class="text-sm text-gray-600">Created: {{ $project->created_at->format('M d, Y') }}</div>
                <div class="text-sm text-gray-600">Updated: {{ $project->updated_at->format('M d, Y') }}</div>
            </div>
        </div>

        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h3 class="text-lg font-semibold mb-3 border-b pb-2">Project Details</h3>
                <p class="text-gray-600 mb-4">{{ $project->description ?? 'No description provided.' }}</p>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Start Date</p>
                        <p>{{ $project->start_date ? date('M d, Y', strtotime($project->start_date)) : 'Not set' }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">End Date</p>
                        <p>{{ $project->end_date ? date('M d, Y', strtotime($project->end_date)) : 'Not set' }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Budget</p>
                        <p>{{ $project->budget ? '$'.number_format($project->budget, 2) : 'Not specified' }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">License Numbers</p>
                        <p>{{ $project->contractor_license ?? 'Not specified' }}</p>
                    </div>
                </div>
            </div>
            
            <div>
                <h3 class="text-lg font-semibold mb-3 border-b pb-2">Location Information</h3>
                <p class="mb-2">{{ $project->address }}<br>
                {{ $project->city }}, {{ $project->state }} {{ $project->zip }}</p>
                
                <div class="mt-4">
                    <h4 class="font-medium mb-2">Contact Information</h4>
                    <p class="mb-1"><span class="text-gray-600">Site Contact:</span> {{ $project->site_contact_name ?? 'Not specified' }}</p>
                    <p><span class="text-gray-600">Contact Phone:</span> {{ $project->site_contact_phone ?? 'Not specified' }}</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Project Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white p-4 rounded shadow-md flex items-center">
            <div class="rounded-full bg-blue-100 p-3 mr-3">
                <i class="fas fa-file-alt text-blue-500"></i>
            </div>
            <div>
                <div class="text-xl font-bold">{{ $permits_count }}</div>
                <div class="text-sm text-gray-600">Permits</div>
            </div>
        </div>
        <div class="bg-white p-4 rounded shadow-md flex items-center">
            <div class="rounded-full bg-yellow-100 p-3 mr-3">
                <i class="fas fa-tasks text-yellow-500"></i>
            </div>
            <div>
                <div class="text-xl font-bold">{{ $tasks_count }}</div>
                <div class="text-sm text-gray-600">Tasks</div>
            </div>
        </div>
        <div class="bg-white p-4 rounded shadow-md flex items-center">
            <div class="rounded-full bg-green-100 p-3 mr-3">
                <i class="fas fa-check-circle text-green-500"></i>
            </div>
            <div>
                <div class="text-xl font-bold">{{ $completed_tasks_count }}</div>
                <div class="text-sm text-gray-600">Completed Tasks</div>
            </div>
        </div>
        <div class="bg-white p-4 rounded shadow-md flex items-center">
            <div class="rounded-full bg-purple-100 p-3 mr-3">
                <i class="fas fa-clipboard-check text-purple-500"></i>
            </div>
            <div>
                <div class="text-xl font-bold">{{ $approved_permits_count }}</div>
                <div class="text-sm text-gray-600">Approved Permits</div>
            </div>
        </div>
    </div>
    
    <!-- Tabs for Permits and Tasks -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="flex border-b">
            <button class="tab-button py-3 px-6 text-blue-600 border-b-2 border-blue-600 font-medium" 
                    data-target="permits-tab">Permits</button>
            <button class="tab-button py-3 px-6 text-gray-600 font-medium" 
                    data-target="tasks-tab">Tasks</button>
        </div>
        
        <div class="p-6">
            <!-- Permits Tab -->
            <div id="permits-tab" class="tab-content">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">Project Permits</h3>
                    <a href="{{ route('permits.create', ['project_id' => $project->id]) }}" 
                       class="bg-blue-500 hover:bg-blue-600 text-white py-1 px-3 rounded text-sm">
                        <i class="fas fa-plus mr-1"></i> Add Permit
                    </a>
                </div>
                
                @if(count($permits) > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Permit Number
                                    </th>
                                    <th class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Type
                                    </th>
                                    <th class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Submitted
                                    </th>
                                    <th class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($permits as $permit)
                                <tr>
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        {{ $permit->permit_number }}
                                    </td>
                                    <td class="px-4 py-3">
                                        {{ $permit->type }}
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        {{ $permit->submission_date ? date('M d, Y', strtotime($permit->submission_date)) : 'N/A' }}
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            @if($permit->status == 'Pending') bg-yellow-100 text-yellow-800
                                            @elseif($permit->status == 'In Review') bg-blue-100 text-blue-800
                                            @elseif($permit->status == 'Approved') bg-green-100 text-green-800
                                            @elseif($permit->status == 'Rejected') bg-red-100 text-red-800
                                            @endif">
                                            {{ $permit->status }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm">
                                        <a href="{{ route('permits.show', $permit) }}" class="text-blue-600 hover:text-blue-900 mr-3">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('permits.edit', $permit) }}" class="text-yellow-600 hover:text-yellow-900">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4 text-gray-500">
                        <p>No permits have been created for this project yet.</p>
                        <a href="{{ route('permits.create', ['project_id' => $project->id]) }}" 
                           class="inline-block mt-2 text-blue-500 hover:text-blue-700">
                            <i class="fas fa-plus mr-1"></i> Create a permit
                        </a>
                    </div>
                @endif
            </div>
            
            <!-- Tasks Tab -->
            <div id="tasks-tab" class="tab-content hidden">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">Project Tasks</h3>
                    <a href="{{ route('tasks.create', ['project_id' => $project->id]) }}" 
                       class="bg-blue-500 hover:bg-blue-600 text-white py-1 px-3 rounded text-sm">
                        <i class="fas fa-plus mr-1"></i> Add Task
                    </a>
                </div>
                
                @if(count($tasks) > 0)
                    <div class="space-y-3">
                        @foreach($tasks as $task)
                            <div class="bg-gray-50 p-4 rounded-lg border @if($task->priority == 'high') border-red-300 @elseif($task->priority == 'medium') border-yellow-300 @else border-green-300 @endif">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <div class="font-medium">{{ $task->title }}</div>
                                        <div class="text-sm text-gray-600 mt-1">{{ $task->description }}</div>
                                    </div>
                                    <div class="flex items-center">
                                        <span class="px-2 py-1 text-xs rounded-full mr-2
                                            @if($task->status == 'pending') bg-yellow-100 text-yellow-800
                                            @elseif($task->status == 'in_progress') bg-blue-100 text-blue-800
                                            @elseif($task->status == 'completed') bg-green-100 text-green-800
                                            @endif">
                                            {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                        </span>
                                        <span class="px-2 py-1 text-xs rounded-full 
                                            @if($task->priority == 'high') bg-red-100 text-red-800
                                            @elseif($task->priority == 'medium') bg-yellow-100 text-yellow-800
                                            @elseif($task->priority == 'low') bg-green-100 text-green-800
                                            @endif">
                                            {{ ucfirst($task->priority) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="flex justify-between items-center mt-2 text-sm">
                                    <div>
                                        <span class="text-gray-500">Due: {{ $task->due_date ? date('M d, Y', strtotime($task->due_date)) : 'No deadline' }}</span>
                                    </div>
                                    <div>
                                        <a href="{{ route('tasks.show', $task) }}" class="text-blue-600 hover:text-blue-900 mr-3">
                                            <i class="fas fa-eye"></i> View
                                        </a>
                                        <a href="{{ route('tasks.edit', $task) }}" class="text-yellow-600 hover:text-yellow-900">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-4 text-gray-500">
                        <p>No tasks have been created for this project yet.</p>
                        <a href="{{ route('tasks.create', ['project_id' => $project->id]) }}" 
                           class="inline-block mt-2 text-blue-500 hover:text-blue-700">
                            <i class="fas fa-plus mr-1"></i> Create a task
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tabButtons = document.querySelectorAll('.tab-button');
        const tabContents = document.querySelectorAll('.tab-content');
        
        tabButtons.forEach(button => {
            button.addEventListener('click', function() {
                const target = this.getAttribute('data-target');
                
                // Update active tab button
                tabButtons.forEach(btn => {
                    btn.classList.remove('text-blue-600', 'border-b-2', 'border-blue-600');
                    btn.classList.add('text-gray-600');
                });
                this.classList.add('text-blue-600', 'border-b-2', 'border-blue-600');
                this.classList.remove('text-gray-600');
                
                // Show target tab content
                tabContents.forEach(content => {
                    content.classList.add('hidden');
                });
                document.getElementById(target).classList.remove('hidden');
            });
        });
    });
</script>
@endsection 