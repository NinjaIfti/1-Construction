@extends('layouts.admin.dashboard')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="mb-6">
        <h1 class="text-2xl font-semibold">Create Permit</h1>
        <p class="text-gray-500 mt-1">Create a new permit on behalf of a client</p>
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
        <form action="{{ route('admin.permits.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf
            
            <div class="mb-6">
                <label for="project_id" class="block text-sm font-medium text-gray-700 mb-1">Select Project</label>
                <select id="project_id" name="project_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md" required>
                    <option value="" disabled selected>Select a project</option>
                    @foreach($projects as $project)
                        <option value="{{ $project->id }}" {{ old('project_id') == $project->id ? 'selected' : '' }}>
                            {{ $project->name }} ({{ $project->address }})
                            - {{ $project->user->name }} ({{ $project->user->company_name ?? 'No company' }})
                        </option>
                    @endforeach
                </select>
                <p class="mt-1 text-sm text-gray-500">
                    Don't see the project? <a href="{{ route('admin.projects.create') }}" class="text-blue-500 hover:underline">Create a new project</a> first.
                </p>
            </div>

            <div class="mb-6">
                <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Permit Type</label>
                <select id="type" name="type" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md" required>
                    <option value="" disabled selected>Select permit type</option>
                    <option value="Building" {{ old('type') == 'Building' ? 'selected' : '' }}>Building</option>
                    <option value="Electrical" {{ old('type') == 'Electrical' ? 'selected' : '' }}>Electrical</option>
                    <option value="Plumbing" {{ old('type') == 'Plumbing' ? 'selected' : '' }}>Plumbing</option>
                    <option value="Mechanical" {{ old('type') == 'Mechanical' ? 'selected' : '' }}>Mechanical (HVAC)</option>
                    <option value="Roofing" {{ old('type') == 'Roofing' ? 'selected' : '' }}>Roofing</option>
                    <option value="Demolition" {{ old('type') == 'Demolition' ? 'selected' : '' }}>Demolition</option>
                    <option value="Excavation" {{ old('type') == 'Excavation' ? 'selected' : '' }}>Excavation/Grading</option>
                    <option value="Fence" {{ old('type') == 'Fence' ? 'selected' : '' }}>Fence</option>
                    <option value="Sign" {{ old('type') == 'Sign' ? 'selected' : '' }}>Sign</option>
                    <option value="Other" {{ old('type') == 'Other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>

            <div class="mb-6">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea id="description" name="description" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="Provide a detailed description of the work to be done">{{ old('description') }}</textarea>
            </div>

            <div class="mb-6">
                <label for="submission_date" class="block text-sm font-medium text-gray-700 mb-1">Submission Date</label>
                <input type="date" id="submission_date" name="submission_date" value="{{ old('submission_date', date('Y-m-d')) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>

            <div class="mb-6">
                <label for="approved_date" class="block text-sm font-medium text-gray-700 mb-1">Approval Date (Optional)</label>
                <input type="date" id="approved_date" name="approved_date" value="{{ old('approved_date') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>

            <div class="mb-6">
                <label for="expiration_date" class="block text-sm font-medium text-gray-700 mb-1">Expiration Date (Optional)</label>
                <input type="date" id="expiration_date" name="expiration_date" value="{{ old('expiration_date') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>

            <div class="mb-6">
                <label for="fee_amount" class="block text-sm font-medium text-gray-700 mb-1">Fee Amount (Optional)</label>
                <div class="mt-1 relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <span class="text-gray-500 sm:text-sm">$</span>
                    </div>
                    <input type="number" step="0.01" min="0" id="fee_amount" name="fee_amount" value="{{ old('fee_amount') }}" class="pl-7 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>
            </div>

            <div class="mb-6">
                <div class="flex items-center">
                    <input id="fee_paid" name="fee_paid" type="checkbox" value="1" {{ old('fee_paid') ? 'checked' : '' }} class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="fee_paid" class="ml-2 block text-sm text-gray-700">Fee Paid</label>
                </div>
            </div>

            <div class="mb-8">
                <label for="documents" class="block text-sm font-medium text-gray-700 mb-1">Supporting Documents</label>
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                    <div class="space-y-1 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-gray-600">
                            <label for="documents" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                <span>Upload files</span>
                                <input id="documents" name="documents[]" type="file" class="sr-only" multiple>
                            </label>
                            <p class="pl-1">or drag and drop</p>
                        </div>
                        <p class="text-xs text-gray-500">
                            PNG, JPG, PDF, DOC up to 10MB each
                        </p>
                        <p class="text-xs text-gray-500 mt-1">
                            Recommended documents: site plans, blueprints, engineering drawings, specification sheets
                        </p>
                    </div>
                </div>
                <div id="file-list" class="mt-2"></div>
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('admin.permits.index') }}" class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Cancel
                </a>
                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    Create Permit
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Display the file names when files are selected
    document.getElementById('documents').addEventListener('change', function(e) {
        const fileList = document.getElementById('file-list');
        fileList.innerHTML = '';
        
        if (this.files.length > 0) {
            fileList.classList.add('mt-4', 'space-y-2');
            
            for (let i = 0; i < this.files.length; i++) {
                const file = this.files[i];
                const fileItem = document.createElement('div');
                fileItem.className = 'flex items-center text-sm text-gray-600';
                
                const icon = document.createElement('svg');
                icon.className = 'h-5 w-5 mr-2 text-gray-400';
                icon.setAttribute('fill', 'currentColor');
                icon.setAttribute('viewBox', '0 0 20 20');
                
                const iconPath = document.createElement('path');
                iconPath.setAttribute('fill-rule', 'evenodd');
                iconPath.setAttribute('d', 'M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z');
                iconPath.setAttribute('clip-rule', 'evenodd');
                
                icon.appendChild(iconPath);
                fileItem.appendChild(icon);
                
                const fileName = document.createElement('span');
                fileName.textContent = file.name;
                fileItem.appendChild(fileName);
                
                fileList.appendChild(fileItem);
            }
        }
    });
</script>
@endsection 