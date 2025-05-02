@extends('layouts.client.dashboard')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-navy">{{ $project->name }} - Tasks</h1>
            <p class="text-gray-500 mt-1">{{ $project->address }}, {{ $project->city }}, {{ $project->state }} {{ $project->zip }}</p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('projects.show', $project) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md flex items-center">
                <i class="fas fa-arrow-left mr-2"></i> Back to Project
            </a>
            <a href="{{ route('projects.tasks.create', $project) }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md flex items-center">
                <i class="fas fa-plus mr-2"></i> Add Task
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <!-- Task Status Summary -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-yellow-100 p-4 rounded shadow">
            <div class="text-xl font-bold">{{ $tasks->where('status', 'Pending')->count() }}</div>
            <div class="text-sm text-gray-600">Pending Tasks</div>
        </div>
        <div class="bg-blue-100 p-4 rounded shadow">
            <div class="text-xl font-bold">{{ $tasks->where('status', 'In Progress')->count() }}</div>
            <div class="text-sm text-gray-600">In Progress</div>
        </div>
        <div class="bg-green-100 p-4 rounded shadow">
            <div class="text-xl font-bold">{{ $tasks->where('status', 'Completed')->count() }}</div>
            <div class="text-sm text-gray-600">Completed</div>
        </div>
    </div>

    <!-- Task List -->
    <div class="bg-white rounded-lg shadow">
        <div class="flex justify-between items-center p-4 border-b">
            <h2 class="text-lg font-semibold">Project Tasks</h2>
            <div>
                <select id="task-filter" class="border rounded px-3 py-1 text-sm">
                    <option value="all">All Tasks</option>
                    <option value="Pending">Pending</option>
                    <option value="In Progress">In Progress</option>
                    <option value="Completed">Completed</option>
                </select>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Title
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Priority
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Due Date
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Assigned To
                        </th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="task-table-body">
                    @forelse($tasks as $task)
                        <tr data-status="{{ $task->status }}" class="task-row">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $task->title }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                @if($task->priority == 'High')
                                    <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800">
                                        High
                                    </span>
                                @elseif($task->priority == 'Medium')
                                    <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">
                                        Medium
                                    </span>
                                @else
                                    <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">
                                        Low
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
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
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $task->due_date ? $task->due_date->format('M d, Y') : 'No due date' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $task->assignedUser ? $task->assignedUser->name : 'Unassigned' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('tasks.show', $task) }}" class="text-blue-600 hover:text-blue-900 mr-3">
                                    View
                                </a>
                                <a href="{{ route('tasks.edit', $task) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">
                                    Edit
                                </a>
                                <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to delete this task?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                No tasks found. <a href="{{ route('projects.tasks.create', $project) }}" class="text-blue-600 hover:underline">Create your first task</a>.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const taskFilter = document.getElementById('task-filter');
    const taskRows = document.querySelectorAll('.task-row');
    
    taskFilter.addEventListener('change', function() {
        const selectedStatus = this.value;
        
        taskRows.forEach(row => {
            const rowStatus = row.dataset.status;
            
            if (selectedStatus === 'all' || rowStatus === selectedStatus) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
});
</script>
@endsection 