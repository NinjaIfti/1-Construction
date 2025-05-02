@extends('layouts.client.dashboard')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-navy">{{ $project->name }} Dashboard</h1>
            <p class="text-gray-500 mt-1">{{ $project->address }}, {{ $project->city }}, {{ $project->state }} {{ $project->zip }}</p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('projects.edit', $project) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md flex items-center">
                <i class="fas fa-edit mr-2"></i> Edit Project
            </a>
            <a href="{{ route('client.permits.create') }}?project_id={{ $project->id }}" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md flex items-center">
                <i class="fas fa-file-upload mr-2"></i> Submit Permit
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <!-- Project Overview Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <!-- Project Status Card -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0 mr-3">
                        <i class="fas fa-project-diagram text-xl text-blue-500"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Project Status</p>
                        @if($project->status == 'Planning')
                            <p class="text-xl font-semibold text-blue-600">Planning</p>
                        @elseif($project->status == 'Active')
                            <p class="text-xl font-semibold text-green-600">Active</p>
                        @elseif($project->status == 'On Hold')
                            <p class="text-xl font-semibold text-yellow-600">On Hold</p>
                        @elseif($project->status == 'Completed')
                            <p class="text-xl font-semibold text-gray-600">Completed</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Permits Summary Card -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0 mr-3">
                        <i class="fas fa-file-alt text-xl text-green-500"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Permits</p>
                        <div class="flex items-center space-x-2">
                            <p class="text-xl font-semibold text-gray-800">{{ $project->permits->count() }}</p>
                            <div class="flex space-x-1">
                                <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">{{ $permitsByStatus['Pending'] ?? 0 }} Pending</span>
                                <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">{{ $permitsByStatus['Approved'] ?? 0 }} Approved</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tasks Summary Card -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0 mr-3">
                        <i class="fas fa-tasks text-xl text-purple-500"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Tasks</p>
                        <div class="flex items-center space-x-2">
                            <p class="text-xl font-semibold text-gray-800">{{ $project->tasks->count() }}</p>
                            <div class="flex space-x-1">
                                <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">{{ $tasksByStatus['In Progress'] ?? 0 }} In Progress</span>
                                <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">{{ $tasksByStatus['Completed'] ?? 0 }} Completed</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Timeline Card -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0 mr-3">
                        <i class="fas fa-calendar-alt text-xl text-red-500"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Timeline</p>
                        <p class="text-xl font-semibold text-gray-800">
                            {{ $project->start_date ? $project->start_date->format('M d') : 'Not set' }} - 
                            {{ $project->end_date ? $project->end_date->format('M d, Y') : 'Not set' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Permits Section -->
    <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-6">
        <div class="px-4 py-5 sm:px-6 bg-gray-50 flex justify-between items-center">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                Recent Permits
            </h3>
            <a href="{{ route('client.permits.create') }}?project_id={{ $project->id }}" class="inline-flex items-center px-3 py-1.5 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700">
                Add Permit
            </a>
        </div>
        
        <div class="border-t border-gray-200">
            @if($recentPermits->count() > 0)
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Permit #
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Type
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Submission Date
                            </th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($recentPermits as $permit)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $permit->permit_number }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $permit->type }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($permit->status == 'Pending')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            Pending
                                        </span>
                                    @elseif($permit->status == 'In Review')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                            In Review
                                        </span>
                                    @elseif($permit->status == 'Approved')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Approved
                                        </span>
                                    @elseif($permit->status == 'Rejected')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            Rejected
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        {{ $permit->submission_date ? $permit->submission_date->format('M d, Y') : 'N/A' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('client.permits.show', $permit) }}" class="text-blue-600 hover:text-blue-900">
                                        View Details
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="px-6 py-3 text-right">
                    <a href="{{ route('projects.show', $project) }}" class="text-blue-600 hover:text-blue-900 text-sm font-medium">
                        View All Permits &rarr;
                    </a>
                </div>
            @else
                <div class="p-6 text-center text-gray-500">
                    <p>No permits have been submitted for this project yet.</p>
                    <a href="{{ route('client.permits.create') }}?project_id={{ $project->id }}" class="inline-flex items-center mt-4 px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700">
                        Submit a Permit
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Recent Tasks Section -->
    <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-6">
        <div class="px-4 py-5 sm:px-6 bg-gray-50 flex justify-between items-center">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                Recent Tasks
            </h3>
            <a href="{{ route('projects.tasks', $project) }}" class="inline-flex items-center px-3 py-1.5 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700">
                View All Tasks
            </a>
        </div>
        
        <div class="border-t border-gray-200">
            @if($recentTasks->count() > 0)
                <ul class="divide-y divide-gray-200">
                    @foreach($recentTasks as $task)
                        <li class="px-6 py-4 flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-900">{{ $task->title }}</p>
                                <p class="text-sm text-gray-500">Due: {{ $task->due_date ? $task->due_date->format('M d, Y') : 'No due date' }}</p>
                            </div>
                            <div class="flex items-center">
                                @if($task->status == 'Pending')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800 mr-3">
                                        Pending
                                    </span>
                                @elseif($task->status == 'In Progress')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800 mr-3">
                                        In Progress
                                    </span>
                                @elseif($task->status == 'Completed')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 mr-3">
                                        Completed
                                    </span>
                                @endif
                                <a href="#" class="text-blue-600 hover:text-blue-900 text-sm font-medium">
                                    View
                                </a>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <div class="px-6 py-3 text-right">
                    <a href="{{ route('projects.tasks', $project) }}" class="text-blue-600 hover:text-blue-900 text-sm font-medium">
                        View All Tasks &rarr;
                    </a>
                </div>
            @else
                <div class="p-6 text-center text-gray-500">
                    <p>No tasks have been created for this project yet.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection 