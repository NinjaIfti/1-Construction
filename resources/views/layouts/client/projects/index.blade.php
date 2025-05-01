@extends('layouts.client.dashboard')

@section('content')
<div id="projects-content">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">My Projects</h2>
        <a href="{{ route('projects.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">
            <i class="fas fa-plus mr-2"></i> New Project
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
            <p>{{ session('error') }}</p>
        </div>
    @endif

    <div class="mb-4">
        <div class="flex items-center">
            <div class="relative w-64 mr-4">
                <input type="text" id="project-search" placeholder="Search projects..." class="w-full p-2 pl-8 border rounded">
                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
            </div>
            <select id="status-filter" class="p-2 border rounded">
                <option value="">All Statuses</option>
                <option value="planning">Planning</option>
                <option value="in_progress">In Progress</option>
                <option value="on_hold">On Hold</option>
                <option value="completed">Completed</option>
            </select>
        </div>
    </div>

    @if(count($projects) > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($projects as $project)
                <div class="bg-white rounded-lg shadow overflow-hidden project-card" data-status="{{ $project->status }}">
                    <div class="p-4 border-b">
                        <div class="flex justify-between items-start">
                            <h3 class="font-bold text-lg">{{ $project->name }}</h3>
                            <span class="text-xs px-2 py-1 rounded-full 
                                @if($project->status == 'planning') bg-blue-100 text-blue-800
                                @elseif($project->status == 'in_progress') bg-yellow-100 text-yellow-800
                                @elseif($project->status == 'on_hold') bg-red-100 text-red-800
                                @elseif($project->status == 'completed') bg-green-100 text-green-800
                                @endif
                            ">
                                {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                            </span>
                        </div>
                        <p class="text-gray-600 text-sm mt-1">{{ $project->address }}</p>
                    </div>
                    <div class="p-4">
                        <div class="flex items-center text-sm mb-2">
                            <i class="fas fa-calendar-alt text-gray-500 mr-2"></i>
                            <span>Start: {{ $project->start_date ? date('M d, Y', strtotime($project->start_date)) : 'Not set' }}</span>
                        </div>
                        <div class="flex items-center text-sm mb-3">
                            <i class="fas fa-flag-checkered text-gray-500 mr-2"></i>
                            <span>End: {{ $project->end_date ? date('M d, Y', strtotime($project->end_date)) : 'Not set' }}</span>
                        </div>
                        
                        <div class="flex justify-between text-sm">
                            <div class="flex items-center">
                                <i class="fas fa-file-alt text-gray-500 mr-1"></i>
                                <span>{{ $project->permits_count }} Permits</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-tasks text-gray-500 mr-1"></i>
                                <span>{{ $project->tasks_count }} Tasks</span>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 p-3 border-t flex justify-between">
                        <a href="{{ route('projects.show', $project) }}" class="text-blue-600 hover:text-blue-800">
                            <i class="fas fa-eye mr-1"></i> View
                        </a>
                        <a href="{{ route('projects.edit', $project) }}" class="text-yellow-600 hover:text-yellow-800">
                            <i class="fas fa-edit mr-1"></i> Edit
                        </a>
                        <a href="{{ route('projects.dashboard', $project) }}" class="text-green-600 hover:text-green-800">
                            <i class="fas fa-chart-line mr-1"></i> Dashboard
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="mt-4">
            {{ $projects->links() }}
        </div>
    @else
        <div class="bg-white p-6 rounded-lg shadow-md text-center">
            <i class="fas fa-clipboard-list text-5xl text-gray-300 mb-4"></i>
            <h3 class="text-xl font-bold mb-2">No Projects Found</h3>
            <p class="text-gray-600 mb-4">You haven't created any projects yet.</p>
            <a href="{{ route('projects.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded inline-block">
                <i class="fas fa-plus mr-2"></i> Create Your First Project
            </a>
        </div>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const projectSearch = document.getElementById('project-search');
        const statusFilter = document.getElementById('status-filter');
        const projectCards = document.querySelectorAll('.project-card');
        
        // Search functionality
        projectSearch.addEventListener('input', filterProjects);
        statusFilter.addEventListener('change', filterProjects);
        
        function filterProjects() {
            const searchTerm = projectSearch.value.toLowerCase();
            const statusValue = statusFilter.value.toLowerCase();
            
            projectCards.forEach(card => {
                const title = card.querySelector('h3').textContent.toLowerCase();
                const address = card.querySelector('p').textContent.toLowerCase();
                const status = card.getAttribute('data-status');
                
                const matchesSearch = title.includes(searchTerm) || address.includes(searchTerm);
                const matchesStatus = statusValue === '' || status === statusValue;
                
                if (matchesSearch && matchesStatus) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }
    });
</script>
@endsection 