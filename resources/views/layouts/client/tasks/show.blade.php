@extends('layouts.client.dashboard')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-navy">Task Details</h1>
            <p class="text-gray-500 mt-1">{{ $task->project->name }}</p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('projects.tasks.index', $task->project) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md flex items-center">
                <i class="fas fa-arrow-left mr-2"></i> Back to Tasks
            </a>
            <a href="{{ route('tasks.edit', $task) }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md flex items-center">
                <i class="fas fa-edit mr-2"></i> Edit Task
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <!-- Task Details -->
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <div class="p-6">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <h2 class="text-xl font-semibold">{{ $task->title }}</h2>
                    <div class="mt-2 space-x-2">
                        @if($task->priority == 'High')
                            <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800">
                                High Priority
                            </span>
                        @elseif($task->priority == 'Medium')
                            <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">
                                Medium Priority
                            </span>
                        @else
                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">
                                Low Priority
                            </span>
                        @endif

                        @if($task->status == 'Completed')
                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">
                                Completed
                            </span>
                        @elseif($task->status == 'In Progress')
                            <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">
                                In Progress
                            </span>
                        @else
                            <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">
                                Pending
                            </span>
                        @endif
                    </div>
                </div>
                
                <div>
                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this task?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </form>
                </div>
            </div>
            
            <div class="border-t border-gray-200 pt-4">
                <dl>
                    <div class="sm:grid sm:grid-cols-3 sm:gap-4 py-4">
                        <dt class="text-sm font-medium text-gray-500">Description</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $task->description ?? 'No description provided.' }}
                        </dd>
                    </div>
                    
                    <div class="sm:grid sm:grid-cols-3 sm:gap-4 py-4 border-t border-gray-200">
                        <dt class="text-sm font-medium text-gray-500">Due Date</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $task->due_date ? $task->due_date->format('F d, Y') : 'No due date set' }}
                        </dd>
                    </div>
                    
                    <div class="sm:grid sm:grid-cols-3 sm:gap-4 py-4 border-t border-gray-200">
                        <dt class="text-sm font-medium text-gray-500">Assigned To</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $task->assignedUser ? $task->assignedUser->name : 'Unassigned' }}
                        </dd>
                    </div>
                    
                    <div class="sm:grid sm:grid-cols-3 sm:gap-4 py-4 border-t border-gray-200">
                        <dt class="text-sm font-medium text-gray-500">Created</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $task->created_at->format('F d, Y \a\t h:i A') }}
                        </dd>
                    </div>
                    
                    <div class="sm:grid sm:grid-cols-3 sm:gap-4 py-4 border-t border-gray-200">
                        <dt class="text-sm font-medium text-gray-500">Last Updated</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $task->updated_at->format('F d, Y \a\t h:i A') }}
                        </dd>
                    </div>
                </dl>
            </div>
            
            <div class="mt-6 flex justify-between">
                <form action="{{ route('tasks.update', $task) }}" method="POST" class="inline-flex">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="title" value="{{ $task->title }}">
                    <input type="hidden" name="description" value="{{ $task->description }}">
                    <input type="hidden" name="priority" value="{{ $task->priority }}">
                    <input type="hidden" name="due_date" value="{{ $task->due_date ? $task->due_date->format('Y-m-d') : '' }}">
                    <input type="hidden" name="assigned_to" value="{{ $task->assigned_to }}">
                    
                    <div class="inline-block">
                        <label for="quick_status" class="sr-only">Update Status</label>
                        <div class="flex items-center">
                            <select id="quick_status" name="status" class="mr-2 block pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                                <option value="Pending" {{ $task->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="In Progress" {{ $task->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="Completed" {{ $task->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Update Status
                            </button>
                        </div>
                    </div>
                </form>
                
                <a href="{{ route('projects.show', $task->project) }}" class="text-blue-600 hover:text-blue-900">
                    View Project <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection 