@extends('layouts.client.dashboard')

@section('content')
<div class="container mx-auto p-4">
    <div class="mb-4 flex items-center">
        <a href="{{ URL::previous() }}" class="bg-gray-500 text-white px-3 py-1 rounded mr-4">
            <i class="fas fa-arrow-left mr-1"></i> Back
        </a>
        <h2 class="text-xl font-bold">Edit Document</h2>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('client.documents.update', $document) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Document Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', $document->name) }}" class="w-full border rounded p-2" required>
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="folder_id" class="block text-sm font-medium text-gray-700 mb-1">Folder</label>
                <select id="folder_id" name="folder_id" class="w-full border rounded p-2">
                    <option value="">Root Folder</option>
                    @foreach($folders as $folder)
                        <option value="{{ $folder->id }}" {{ old('folder_id', $document->folder_id) == $folder->id ? 'selected' : '' }}>
                            {{ $folder->name }}
                        </option>
                    @endforeach
                </select>
                @error('folder_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description (Optional)</label>
                <textarea id="description" name="description" class="w-full border rounded p-2" rows="3">{{ old('description', $document->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">File Information</label>
                <div class="bg-gray-100 p-3 rounded">
                    <p class="text-sm text-gray-600">
                        <strong>File Type:</strong> {{ strtoupper($document->extension) }}
                    </p>
                    <p class="text-sm text-gray-600">
                        <strong>File Size:</strong> {{ $document->formatted_file_size }}
                    </p>
                    <p class="text-sm text-gray-600">
                        <strong>Uploaded:</strong> {{ $document->created_at->format('M d, Y g:i A') }}
                    </p>
                </div>
            </div>
            
            <div class="flex items-center justify-between">
                <a href="{{ route('client.documents.index', ['folder_id' => $document->folder_id]) }}" class="bg-gray-300 hover:bg-gray-400 px-4 py-2 rounded">
                    Cancel
                </a>
                <div>
                    <button type="button" onclick="toggleReplaceModal()" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded mr-2">
                        Replace File
                    </button>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                        Save Changes
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Replace File Modal -->
<div id="replace-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold">Replace File</h3>
            <button onclick="toggleReplaceModal()" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <form action="{{ route('client.documents.replace', $document) }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-4">
                <p class="text-gray-700 mb-2">You are about to replace <strong>{{ $document->name }}</strong>. The file name and other properties will remain the same, but the content will be updated.</p>
                
                <div class="border-2 border-dashed border-gray-300 rounded p-4 text-center">
                    <input type="file" id="replacement-file" name="file" class="hidden" required onchange="updateReplacementFileName()">
                    <label for="replacement-file" class="cursor-pointer">
                        <i class="fas fa-cloud-upload-alt text-gray-400 text-2xl mb-2"></i>
                        <p class="text-sm text-gray-500" id="replacement-file-name">Click to select a replacement file</p>
                    </label>
                </div>
                <p class="text-xs text-gray-500 mt-1">Supported formats: PDF, JPG, PNG, DOC, DOCX, XLS, XLSX, TXT (max 10MB)</p>
            </div>
            
            <div class="flex justify-end">
                <button type="button" onclick="toggleReplaceModal()" class="bg-gray-300 hover:bg-gray-400 px-4 py-2 rounded mr-2">
                    Cancel
                </button>
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                    Replace File
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function toggleReplaceModal() {
        const modal = document.getElementById('replace-modal');
        modal.classList.toggle('hidden');
    }
    
    function updateReplacementFileName() {
        const fileInput = document.getElementById('replacement-file');
        const fileName = document.getElementById('replacement-file-name');
        
        if (fileInput.files.length > 0) {
            fileName.textContent = fileInput.files[0].name;
        } else {
            fileName.textContent = 'Click to select a replacement file';
        }
    }
</script>
@endsection