@extends('layouts.admin.dashboard')

@section('content')
<div class="animate-fadeIn">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl md:text-2xl font-bold">Upload Document</h2>
        <a href="{{ route('admin.documents.index') }}" class="text-blue-500 hover:underline flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Back to Documents
        </a>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Upload Document Form -->
        <div class="md:col-span-2">
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-navy border-b pb-2 mb-4">Document Information</h3>
                
                <form action="{{ route('admin.documents.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-4">
                        <label for="contractor_id" class="block text-gray-700 font-medium mb-2">Contractor</label>
                        <select 
                            id="contractor_id" 
                            name="contractor_id" 
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required
                            x-on:change="loadFolders()"
                            x-data="{ loadFolders() { 
                                fetch('{{ route('admin.documents.list-folders') }}?contractor_id=' + this.value)
                                    .then(response => response.json())
                                    .then(data => {
                                        // Handle folder data
                                        console.log(data);
                                    });
                            } }"
                        >
                            <option value="">Select Contractor</option>
                            @foreach($contractors as $contractor)
                                <option value="{{ $contractor->id }}">{{ $contractor->name }} - {{ $contractor->company_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-medium mb-2">Document Name</label>
                        <input 
                            type="text" 
                            id="name" 
                            name="name" 
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required
                        >
                    </div>
                    
                    <div class="mb-4">
                        <label for="description" class="block text-gray-700 font-medium mb-2">Description (Optional)</label>
                        <textarea 
                            id="description" 
                            name="description" 
                            rows="3"
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        ></textarea>
                    </div>
                    
                    <div class="mb-4">
                        <label for="category" class="block text-gray-700 font-medium mb-2">Category</label>
                        <select 
                            id="category" 
                            name="category" 
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required
                        >
                            <option value="">Select Category</option>
                            <option value="verification">Verification Documents</option>
                            <option value="permits">Permits</option>
                            <option value="contracts">Contracts</option>
                            <option value="invoices">Invoices</option>
                            <option value="general">General Documents</option>
                        </select>
                    </div>
                    
                    <div class="mb-4">
                        <label for="subcategory" class="block text-gray-700 font-medium mb-2">Subcategory/Folder (Optional)</label>
                        <input 
                            type="text" 
                            id="subcategory" 
                            name="subcategory" 
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Leave empty to save in the main category folder"
                        >
                    </div>
                    
                    <div class="mb-6">
                        <label for="file" class="block text-gray-700 font-medium mb-2">File</label>
                        <div
                            class="border-2 border-dashed rounded p-4 md:p-6 flex flex-col items-center justify-center cursor-pointer transition-colors"
                            x-data="{ dragActive: false, fileName: '' }"
                            x-on:dragover.prevent="dragActive = true"
                            x-on:dragleave.prevent="dragActive = false"
                            x-on:drop.prevent="dragActive = false; handleFileDrop($event)"
                            x-on:click="document.getElementById('file').click()"
                            x-bind:class="dragActive ? 'border-blue-500 bg-blue-50' : 'border-gray-300'"
                        >
                            <input 
                                type="file" 
                                id="file" 
                                name="file" 
                                class="hidden" 
                                x-on:change="fileName = $event.target.files[0].name"
                                required
                            >
                            <i class="fas fa-cloud-upload-alt text-2xl md:text-3xl text-gray-400 mb-2"></i>
                            <p class="text-xs md:text-sm text-gray-500 text-center" x-show="!fileName">Drag and drop file here, or click to browse</p>
                            <p class="text-xs md:text-sm text-blue-500 text-center" x-show="fileName" x-text="'Selected: ' + fileName"></p>
                        </div>
                    </div>
                    
                    <div class="flex justify-end">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                            <i class="fas fa-upload mr-2"></i> Upload Document
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Create Folder Form -->
        <div class="md:col-span-1">
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-navy border-b pb-2 mb-4">Create New Folder</h3>
                
                <form action="{{ route('admin.documents.create-folder') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label for="folder_contractor_id" class="block text-gray-700 font-medium mb-2">Contractor</label>
                        <select 
                            id="folder_contractor_id" 
                            name="contractor_id" 
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required
                        >
                            <option value="">Select Contractor</option>
                            @foreach($contractors as $contractor)
                                <option value="{{ $contractor->id }}">{{ $contractor->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mb-4">
                        <label for="parent_folder" class="block text-gray-700 font-medium mb-2">Parent Folder (Optional)</label>
                        <input 
                            type="text" 
                            id="parent_folder" 
                            name="parent_folder" 
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Leave empty to create at root level"
                        >
                    </div>
                    
                    <div class="mb-6">
                        <label for="folder_name" class="block text-gray-700 font-medium mb-2">Folder Name</label>
                        <input 
                            type="text" 
                            id="folder_name" 
                            name="folder_name" 
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required
                        >
                    </div>
                    
                    <div class="flex justify-end">
                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                            <i class="fas fa-folder-plus mr-2"></i> Create Folder
                        </button>
                    </div>
                </form>
            </div>
            
            <!-- Tip Box -->
            <div class="bg-white rounded-lg shadow p-6 mt-6">
                <h3 class="text-lg font-semibold text-navy mb-2">Tips</h3>
                <ul class="text-sm text-gray-600 space-y-2">
                    <li><i class="fas fa-info-circle text-blue-500 mr-2"></i> Documents are organized by contractor name</li>
                    <li><i class="fas fa-info-circle text-blue-500 mr-2"></i> Create folders to better organize documents</li>
                    <li><i class="fas fa-info-circle text-blue-500 mr-2"></i> Use categories like 'verification', 'permits', etc.</li>
                    <li><i class="fas fa-info-circle text-blue-500 mr-2"></i> Subcategories let you create deeper organization</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
    function handleFileDrop(event) {
        document.getElementById('file').files = event.dataTransfer.files;
        fileName = event.dataTransfer.files[0].name;
    }
</script>
@endsection 