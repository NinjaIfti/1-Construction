@extends('layouts.client.dashboard')

@section('content')
<div id="edit-project-content">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">Edit Project: {{ $project->name }}</h2>
        <a href="{{ route('projects.show', $project) }}" class="text-blue-500 hover:text-blue-700">
            <i class="fas fa-arrow-left mr-1"></i> Back to Project
        </a>
    </div>

    @if($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
            <p class="font-bold">Validation Error</p>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-md p-6">
        <form action="{{ route('projects.update', $project) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Basic Information -->
                <div>
                    <h3 class="text-lg font-semibold mb-4 border-b pb-2">Basic Information</h3>
                    
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Project Name *</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $project->name) }}" 
                            class="w-full p-2 border rounded focus:ring focus:ring-blue-300" required>
                    </div>
                    
                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea name="description" id="description" rows="3" 
                            class="w-full p-2 border rounded focus:ring focus:ring-blue-300">{{ old('description', $project->description) }}</textarea>
                    </div>
                    
                    <div class="mb-4">
                        <label for="project_type" class="block text-sm font-medium text-gray-700 mb-1">Project Type *</label>
                        <select name="project_type" id="project_type" 
                            class="w-full p-2 border rounded focus:ring focus:ring-blue-300" required>
                            <option value="">Select Project Type</option>
                            <option value="residential" {{ old('project_type', $project->project_type) == 'residential' ? 'selected' : '' }}>Residential</option>
                            <option value="commercial" {{ old('project_type', $project->project_type) == 'commercial' ? 'selected' : '' }}>Commercial</option>
                            <option value="industrial" {{ old('project_type', $project->project_type) == 'industrial' ? 'selected' : '' }}>Industrial</option>
                            <option value="infrastructure" {{ old('project_type', $project->project_type) == 'infrastructure' ? 'selected' : '' }}>Infrastructure</option>
                            <option value="mixed_use" {{ old('project_type', $project->project_type) == 'mixed_use' ? 'selected' : '' }}>Mixed Use</option>
                        </select>
                    </div>
                    
                    <div class="mb-4">
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status *</label>
                        <select name="status" id="status" 
                            class="w-full p-2 border rounded focus:ring focus:ring-blue-300" required>
                            <option value="planning" {{ old('status', $project->status) == 'planning' ? 'selected' : '' }}>Planning</option>
                            <option value="in_progress" {{ old('status', $project->status) == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="on_hold" {{ old('status', $project->status) == 'on_hold' ? 'selected' : '' }}>On Hold</option>
                            <option value="completed" {{ old('status', $project->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </div>
                </div>
                
                <!-- Location and Schedule -->
                <div>
                    <h3 class="text-lg font-semibold mb-4 border-b pb-2">Location and Schedule</h3>
                    
                    <div class="mb-4">
                        <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Project Address *</label>
                        <input type="text" name="address" id="address" value="{{ old('address', $project->address) }}" 
                            class="w-full p-2 border rounded focus:ring focus:ring-blue-300" required>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="city" class="block text-sm font-medium text-gray-700 mb-1">City *</label>
                            <input type="text" name="city" id="city" value="{{ old('city', $project->city) }}" 
                                class="w-full p-2 border rounded focus:ring focus:ring-blue-300" required>
                        </div>
                        <div>
                            <label for="state" class="block text-sm font-medium text-gray-700 mb-1">State *</label>
                            <input type="text" name="state" id="state" value="{{ old('state', $project->state) }}" 
                                class="w-full p-2 border rounded focus:ring focus:ring-blue-300" required>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label for="zip" class="block text-sm font-medium text-gray-700 mb-1">ZIP Code *</label>
                        <input type="text" name="zip" id="zip" value="{{ old('zip', $project->zip) }}" 
                            class="w-full p-2 border rounded focus:ring focus:ring-blue-300" required>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">Start Date</label>
                            <input type="date" name="start_date" id="start_date" 
                                value="{{ old('start_date', $project->start_date ? date('Y-m-d', strtotime($project->start_date)) : '') }}" 
                                class="w-full p-2 border rounded focus:ring focus:ring-blue-300">
                        </div>
                        <div>
                            <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">Target End Date</label>
                            <input type="date" name="end_date" id="end_date" 
                                value="{{ old('end_date', $project->end_date ? date('Y-m-d', strtotime($project->end_date)) : '') }}" 
                                class="w-full p-2 border rounded focus:ring focus:ring-blue-300">
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Additional Information -->
            <div class="mt-6">
                <h3 class="text-lg font-semibold mb-4 border-b pb-2">Additional Information</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <div class="mb-4">
                            <label for="budget" class="block text-sm font-medium text-gray-700 mb-1">Budget Estimate ($)</label>
                            <input type="number" step="0.01" min="0" name="budget" id="budget" value="{{ old('budget', $project->budget) }}" 
                                class="w-full p-2 border rounded focus:ring focus:ring-blue-300">
                        </div>
                        
                        <div class="mb-4">
                            <label for="contractor_license" class="block text-sm font-medium text-gray-700 mb-1">License Numbers</label>
                            <input type="text" name="contractor_license" id="contractor_license" value="{{ old('contractor_license', $project->contractor_license) }}" 
                                class="w-full p-2 border rounded focus:ring focus:ring-blue-300" 
                                placeholder="Building permit, contractor license, etc.">
                        </div>
                    </div>
                    
                    <div>
                        <div class="mb-4">
                            <label for="site_contact_name" class="block text-sm font-medium text-gray-700 mb-1">Site Contact Name</label>
                            <input type="text" name="site_contact_name" id="site_contact_name" value="{{ old('site_contact_name', $project->site_contact_name) }}" 
                                class="w-full p-2 border rounded focus:ring focus:ring-blue-300">
                        </div>
                        
                        <div class="mb-4">
                            <label for="site_contact_phone" class="block text-sm font-medium text-gray-700 mb-1">Site Contact Phone</label>
                            <input type="text" name="site_contact_phone" id="site_contact_phone" value="{{ old('site_contact_phone', $project->site_contact_phone) }}" 
                                class="w-full p-2 border rounded focus:ring focus:ring-blue-300">
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-6 flex justify-between">
                <div>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">
                        <i class="fas fa-save mr-2"></i> Update Project
                    </button>
                    <a href="{{ route('projects.show', $project) }}" class="ml-2 bg-gray-300 hover:bg-gray-400 text-gray-800 py-2 px-4 rounded">
                        Cancel
                    </a>
                </div>
                
                <!-- Delete project button -->
                <form action="{{ route('projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this project? This action cannot be undone.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">
                        <i class="fas fa-trash-alt mr-2"></i> Delete Project
                    </button>
                </form>
            </div>
        </form>
    </div>
</div>
@endsection 