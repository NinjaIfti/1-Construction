@extends('layouts.client.dashboard')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-navy">My Tasks</h1>
        <div>
            <a href="{{ route('client.dashboard') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md flex items-center">
                <i class="fas fa-arrow-left mr-2"></i> Back to Dashboard
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
            <h2 class="text-lg font-semibold">Tasks Assigned to Me</h2>
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
                            Project
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
                                {{ $task->project->name }}
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
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('tasks.show', $task) }}" class="text-blue-600 hover:text-blue-900 mr-3">
                                    View
                                </a>
                                <form action="{{ route('tasks.update', $task) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="title" value="{{ $task->title }}">
                                    <input type="hidden" name="description" value="{{ $task->description }}">
                                    <input type="hidden" name="priority" value="{{ $task->priority }}">
                                    <input type="hidden" name="due_date" value="{{ $task->due_date ? $task->due_date->format('Y-m-d') : '' }}">
                                    <input type="hidden" name="assigned_to" value="{{ $task->assigned_to }}">
                                    
                                    @if($task->status != 'Completed')
                                        <input type="hidden" name="status" value="Completed">
                                        <button type="submit" class="text-green-600 hover:text-green-900">
                                            Mark Complete
                                        </button>
                                    @else
                                        <input type="hidden" name="status" value="In Progress">
                                        <button type="submit" class="text-yellow-600 hover:text-yellow-900">
                                            Reopen
                                        </button>
                                    @endif
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                No tasks assigned to you yet.
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