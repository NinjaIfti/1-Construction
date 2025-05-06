@extends('layouts.admin.dashboard')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Project Details</h1>
        <div class="flex space-x-4">
            <a href="{{ route('admin.projects.edit', $project) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                <i class="fas fa-edit mr-2"></i>Edit Project
            </a>
            <a href="{{ route('admin.projects.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                <i class="fas fa-arrow-left mr-2"></i>Back to Projects
            </a>
        </div>
    </div>

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <!-- Project Header -->
        <div class="p-6 border-b border-gray-200">
            <div class="flex justify-between items-start">
                <div>
                    <h2 class="text-xl font-semibold text-gray-800">{{ $project->name }}</h2>
                    <p class="text-gray-600 mt-1">Created on {{ $project->created_at->format('M d, Y') }}</p>
                </div>
                <div class="text-right">
                    <span class="px-3 py-1 rounded-full text-sm font-semibold
                        {{ $project->status === 'completed' ? 'bg-green-100 text-green-800' : 
                           ($project->status === 'in_progress' ? 'bg-blue-100 text-blue-800' : 
                            'bg-yellow-100 text-yellow-800') }}">
                        {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Project Details -->
        <div class="p-6 border-b border-gray-200">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Contractor Information</h3>
                    <div class="space-y-2">
                        <p class="text-gray-600">
                            <span class="font-medium">Company:</span> {{ $project->contractor->company_name }}
                        </p>
                        <p class="text-gray-600">
                            <span class="font-medium">Contact:</span> {{ $project->contractor->name }}
                        </p>
                        <p class="text-gray-600">
                            <span class="font-medium">Email:</span> {{ $project->contractor->email }}
                        </p>
                    </div>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Project Information</h3>
                    <div class="space-y-2">
                        <p class="text-gray-600">
                            <span class="font-medium">Start Date:</span> {{ $project->start_date->format('M d, Y') }}
                        </p>
                        <p class="text-gray-600">
                            <span class="font-medium">End Date:</span> {{ $project->end_date ? $project->end_date->format('M d, Y') : 'Not set' }}
                        </p>
                        <p class="text-gray-600">
                            <span class="font-medium">Budget:</span> ${{ number_format($project->budget, 2) }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Project Description -->
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Description</h3>
            <p class="text-gray-600">{{ $project->description }}</p>
        </div>

        <!-- Documents Section (replacing Tasks) -->
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Documents</h3>
            <div class="space-y-4">
                @if(isset($project->permits) && $project->permits->isNotEmpty() && $project->permits->first()->documents->isNotEmpty())
                    @foreach($project->permits->first()->documents as $document)
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h4 class="font-medium text-gray-900">{{ $document->name }}</h4>
                                    <p class="text-sm text-gray-600 mt-1">{{ $document->description ?? 'No description' }}</p>
                                </div>
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                    {{ $document->document_type ?? 'Document' }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-gray-600">No documents have been uploaded for this project yet.</p>
                @endif
            </div>
        </div>

        <!-- Project Actions -->
        <div class="p-6 bg-gray-50">
            <div class="flex justify-end space-x-4">
                @if($project->status === 'pending')
                    <form action="{{ route('admin.projects.approve', $project) }}" method="POST" class="inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            <i class="fas fa-check mr-2"></i>Approve Project
                        </button>
                    </form>
                @endif
                @if($project->status === 'in_progress')
                    <form action="{{ route('admin.projects.complete', $project) }}" method="POST" class="inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            <i class="fas fa-check-double mr-2"></i>Mark as Completed
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection 