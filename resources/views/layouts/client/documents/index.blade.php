@extends('layouts.client.dashboard')

@section('content')
<div class="flex justify-between items-center mb-4">
    <h2 class="text-2xl font-bold">Documents</h2>
    <div>
        @if($currentFolder)
            <a href="{{ route('client.documents.index', ['folder_id' => $currentFolder->parent_folder_id]) }}" class="bg-gray-500 text-white px-3 py-1 rounded mr-2">
                <i class="fas fa-arrow-left mr-1"></i> Back
            </a>
        @endif
        <span class="text-gray-600">
            {{ $currentFolder ? 'Current folder: ' . $currentFolder->name : 'Root folder' }}
        </span>
    </div>
</div>

<div class="flex justify-between mb-4">
    <div>
        <button type="button" onclick="toggleUploadModal()" class="bg-blue-500 text-white px-4 py-2 rounded mr-2">
            <i class="fas fa-upload mr-1"></i> Upload Document
        </button>
        <button type="button" onclick="toggleFolderModal()" class="bg-gray-300 px-4 py-2 rounded">
            <i class="fas fa-folder-plus mr-1"></i> Create Folder
        </button>
    </div>
    <div>
        <form action="{{ route('client.documents.search') }}" method="GET" class="flex">
            <input type="text" name="query" class="border rounded p-2" placeholder="Search documents..." required>
            <button type="submit" class="bg-blue-500 text-white px-4 rounded-r">
                <i class="fas fa-search"></i>
            </button>
        </form>
    </div>
</div>

@if(session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
        <p>{{ session('success') }}</p>
    </div>
@endif

@if(session('error'))
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
        <p>{{ session('error') }}</p>
    </div>
@endif

<!-- Folders -->
@if($folders->count() > 0 || $documents->count() > 0)
    <div class="bg-white rounded-lg shadow overflow-hidden mb-4">
        @if($folders->count() > 0)
            <div class="p-3 border-b bg-gray-50">
                <span class="font-bold">Folders</span>
            </div>
            
            @foreach($folders as $folder)
                <div class="p-4 border-b hover:bg-gray-50 flex items-center">
                    <a href="{{ route('client.documents.index', ['folder_id' => $folder->id]) }}" class="flex-grow flex items-center">
                        <i class="fas fa-folder text-yellow-500 mr-3 text-xl"></i>
                        <div class="font-medium">{{ $folder->name }}</div>
                    </a>
                    <div class="flex space-x-2">
                        <form action="{{ route('client.documents.destroy-folder', $folder) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this folder and all its contents? This action cannot be undone.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        @endif
        
        <!-- Documents -->
        @if($documents->count() > 0)
            <div class="p-3 border-b bg-gray-50">
                <span class="font-bold">Documents</span>
            </div>
            
            @foreach($documents as $document)
                <div class="p-4 border-b hover:bg-gray-50 flex items-center">
                    <div class="flex-grow flex items-center">
                        @if($document->isPdf())
                            <i class="fas fa-file-pdf text-red-500 mr-3 text-xl"></i>
                        @elseif($document->isImage())
                            <i class="fas fa-file-image text-green-500 mr-3 text-xl"></i>
                        @else
                            <i class="fas fa-file text-blue-500 mr-3 text-xl"></i>
                        @endif
                        <div>
                            <div class="font-medium">{{ $document->name }}</div>
                            <div class="text-sm text-gray-500">
                                Added {{ $document->created_at->format('M d, Y') }} - {{ $document->formatted_file_size }}
                            </div>
                        </div>
                    </div>
                    <div class="flex space-x-3">
                        <a href="{{ route('client.documents.download', $document) }}" class="text-blue-500 hover:text-blue-700" title="Download">
                            <i class="fas fa-download"></i>
                        </a>
                        <a href="{{ route('client.documents.preview', $document) }}" class="text-gray-500 hover:text-gray-700" title="Preview">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('client.documents.edit', $document) }}" class="text-yellow-500 hover:text-yellow-700" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('client.documents.destroy', $document) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this document? This action cannot be undone.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700" title="Delete">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@else
    <div class="bg-white rounded-lg shadow p-8 text-center">
        <i class="fas fa-folder-open text-gray-400 text-5xl mb-4"></i>
        <h3 class="text-xl font-medium text-gray-600 mb-2">No Documents Found</h3>
        <p class="text-gray-500 mb-4">You haven't uploaded any documents to this folder yet.</p>
        <button onclick="toggleUploadModal()" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
            Upload Your First Document
        </button>
    </div>
@endif

<!-- Upload Document Modal -->
<div id="upload-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold">Upload Document</h3>
            <button onclick="toggleUploadModal()" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <form action="{{ route('client.documents.upload') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if($currentFolder)
                <input type="hidden" name="folder_id" value="{{ $currentFolder->id }}">
            @else
                <div class="mb-4">
                    <label for="folder_id" class="block text-sm font-medium text-gray-700 mb-1">Select Folder</label>
                    <select id="folder_id" name="folder_id" class="w-full border rounded p-2" required>
                        <option value="">-- Select a folder --</option>
                        @foreach($folders as $folder)
                            <option value="{{ $folder->id }}">{{ $folder->name }}</option>
                        @endforeach
                    </select>
                </div>
            @endif
            
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Document Name</label>
                <input type="text" id="name" name="name" class="w-full border rounded p-2" required>
            </div>
            
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description (Optional)</label>
                <textarea id="description" name="description" class="w-full border rounded p-2" rows="2"></textarea>
            </div>
            
            <div class="mb-4">
                <label for="file" class="block text-sm font-medium text-gray-700 mb-1">Select File</label>
                <div class="border-2 border-dashed border-gray-300 rounded p-4 text-center">
                    <input type="file" id="file" name="file" class="hidden" required onchange="updateFileName()">
                    <label for="file" class="cursor-pointer">
                        <i class="fas fa-cloud-upload-alt text-gray-400 text-2xl mb-2"></i>
                        <p class="text-sm text-gray-500" id="file-name">Click to select a file or drag and drop</p>
                    </label>
                </div>
                <p class="text-xs text-gray-500 mt-1">Supported formats: PDF, JPG, PNG, DOC, DOCX, XLS, XLSX, TXT (max 10MB)</p>
            </div>
            
            <div class="flex justify-end">
                <button type="button" onclick="toggleUploadModal()" class="bg-gray-300 hover:bg-gray-400 px-4 py-2 rounded mr-2">
                    Cancel
                </button>
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                    Upload
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Create Folder Modal -->
<div id="folder-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold">Create New Folder</h3>
            <button onclick="toggleFolderModal()" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <form action="{{ route('client.documents.create-folder') }}" method="POST">
            @csrf
            <input type="hidden" name="parent_folder_id" value="{{ $currentFolder ? $currentFolder->id : '' }}">
            
            <div class="mb-4">
                <label for="folder-name" class="block text-sm font-medium text-gray-700 mb-1">Folder Name</label>
                <input type="text" id="folder-name" name="name" class="w-full border rounded p-2" required>
            </div>
            
            <div class="flex justify-end">
                <button type="button" onclick="toggleFolderModal()" class="bg-gray-300 hover:bg-gray-400 px-4 py-2 rounded mr-2">
                    Cancel
                </button>
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                    Create Folder
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function toggleUploadModal() {
        const modal = document.getElementById('upload-modal');
        modal.classList.toggle('hidden');
    }
    
    function toggleFolderModal() {
        const modal = document.getElementById('folder-modal');
        modal.classList.toggle('hidden');
    }
    
    function updateFileName() {
        const fileInput = document.getElementById('file');
        const fileName = document.getElementById('file-name');
        
        if (fileInput.files.length > 0) {
            fileName.textContent = fileInput.files[0].name;
        } else {
            fileName.textContent = 'Click to select a file or drag and drop';
        }
    }
    
    // Enable drag and drop
    const dropArea = document.querySelector('.border-dashed');
    const fileInput = document.getElementById('file');
    
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, preventDefaults, false);
    });
    
    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }
    
    ['dragenter', 'dragover'].forEach(eventName => {
        dropArea.addEventListener(eventName, highlight, false);
    });
    
    ['dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, unhighlight, false);
    });
    
    function highlight() {
        dropArea.classList.add('border-blue-500', 'bg-blue-50');
    }
    
    function unhighlight() {
        dropArea.classList.remove('border-blue-500', 'bg-blue-50');
    }
    
    dropArea.addEventListener('drop', handleDrop, false);
    
    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        fileInput.files = files;
        updateFileName();
    }
</script>
@endsection