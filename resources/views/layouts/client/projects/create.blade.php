@extends('layouts.client.dashboard')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-navy">Create New Project</h1>
        <p class="text-gray-500 mt-1">Add a new construction project to your account</p>
    </div>

    @if(session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
            <p>{{ session('error') }}</p>
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
            <p class="font-bold">Please fix the following errors:</p>
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <form action="{{ route('projects.store') }}" method="POST" class="p-6">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Project Name*</label>
                    <input id="name" name="name" type="text" value="{{ old('name') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                </div>
                
                <div>
                    <label for="project_type" class="block text-sm font-medium text-gray-700 mb-1">Project Type*</label>
                    <select id="project_type" name="project_type" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                        <option value="" disabled {{ old('project_type') ? '' : 'selected' }}>Select a project type</option>
                        <option value="Residential New Construction" {{ old('project_type') == 'Residential New Construction' ? 'selected' : '' }}>Residential New Construction</option>
                        <option value="Residential Remodel" {{ old('project_type') == 'Residential Remodel' ? 'selected' : '' }}>Residential Remodel</option>
                        <option value="Commercial New Construction" {{ old('project_type') == 'Commercial New Construction' ? 'selected' : '' }}>Commercial New Construction</option>
                        <option value="Commercial Remodel" {{ old('project_type') == 'Commercial Remodel' ? 'selected' : '' }}>Commercial Remodel</option>
                        <option value="Industrial" {{ old('project_type') == 'Industrial' ? 'selected' : '' }}>Industrial</option>
                        <option value="Infrastructure" {{ old('project_type') == 'Infrastructure' ? 'selected' : '' }}>Infrastructure</option>
                        <option value="Solar" {{ old('project_type') == 'Solar' ? 'selected' : '' }}>Solar</option>
                        <option value="Other" {{ old('project_type') == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>
                
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Project Status*</label>
                    <select id="status" name="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                        <option value="Planning" {{ old('status') == 'Planning' ? 'selected' : '' }}>Planning</option>
                        <option value="Active" {{ old('status') == 'Active' ? 'selected' : '' }}>Active</option>
                        <option value="On Hold" {{ old('status') == 'On Hold' ? 'selected' : '' }}>On Hold</option>
                        <option value="Completed" {{ old('status') == 'Completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>
                
                <div>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">Start Date</label>
                            <input id="start_date" name="start_date" type="date" value="{{ old('start_date') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">End Date</label>
                            <input id="end_date" name="end_date" type="date" value="{{ old('end_date') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>
                    </div>
                </div>
                
                <div class="md:col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea id="description" name="description" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">{{ old('description') }}</textarea>
                </div>
                
                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Street Address*</label>
                    <input id="address" name="address" type="text" value="{{ old('address') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                </div>
                
                <div class="grid grid-cols-3 gap-3">
                    <div>
                        <label for="city" class="block text-sm font-medium text-gray-700 mb-1">City*</label>
                        <input id="city" name="city" type="text" value="{{ old('city') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                    </div>
                    <div>
                        <label for="state" class="block text-sm font-medium text-gray-700 mb-1">State*</label>
                        <input id="state" name="state" type="text" value="{{ old('state') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                    </div>
                    <div>
                        <label for="zip" class="block text-sm font-medium text-gray-700 mb-1">ZIP Code*</label>
                        <input id="zip" name="zip" type="text" value="{{ old('zip') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                    </div>
                </div>
            </div>

            <div class="flex justify-end space-x-3 mt-6">
                <a href="{{ route('client.dashboard') }}" class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Cancel
                </a>
                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    Create Project
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 