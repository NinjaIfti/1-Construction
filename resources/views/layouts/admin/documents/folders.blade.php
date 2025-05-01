@extends('layouts.admin.dashboard')

@section('content')
<div class="animate-fadeIn">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl md:text-2xl font-bold">{{ $contractor->name }}'s Documents</h2>
        <a href="{{ route('admin.documents.upload') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
            <i class="fas fa-file-upload mr-2"></i> Upload Document
        </a>
    </div>
    
    <div class="bg-white rounded-lg shadow p-4">
        <div class="flex items-center mb-4">
            <form method="GET" action="{{ route('admin.documents.folders') }}" class="flex items-center">
                <select class="border rounded px-4 py-2 mr-2" id="folderContractorSelect" name="contractor_id" onchange="this.form.submit()">
                    <option value="">Select Contractor</option>
                    @foreach($contractors as $contractorOption)
                        <option value="{{ $contractorOption->id }}" @if($contractor->id == $contractorOption->id) selected @endif>
                            {{ $contractorOption->name }}
                        </option>
                    @endforeach
                </select>
            </form>
            
            <form method="POST" action="{{ route('admin.documents.create-folder') }}" class="flex items-center ml-4">
                @csrf
                <input type="hidden" name="contractor_id" value="{{ $contractor->id }}">
                <input type="text" name="folder_name" placeholder="New folder name" class="border rounded px-4 py-2 mr-2" required>
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-3 py-2 rounded">
                    <i class="fas fa-folder-plus mr-1"></i> Create Folder
                </button>
            </form>
        </div>
        
        <!-- Document folder structure -->
        <div class="mt-6">
            <h3 class="text-lg font-medium mb-4">Root Folders</h3>
            
            @if($rootFolders->isEmpty())
                <div class="text-gray-500 p-4 bg-gray-50 rounded">
                    No folders found. Create a folder to get started.
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @foreach($rootFolders as $folder)
                        <div class="border rounded-lg p-4 hover:bg-gray-50">
                            <a href="{{ route('admin.documents.folder', $folder) }}" class="flex items-start">
                                <div class="text-yellow-500 mr-3">
                                    <i class="fas fa-folder fa-2x"></i>
                                </div>
                                <div>
                                    <h4 class="font-medium">{{ $folder->name }}</h4>
                                    <div class="text-sm text-gray-500">
                                        {{ $folder->subfolders->count() }} subfolder(s), 
                                        {{ $folder->documents->count() }} document(s)
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
        
        <!-- Recent Documents Section -->
        <div class="mt-8">
            <h3 class="text-lg font-medium mb-4">Recent Documents</h3>
            
            @php
                $recentDocuments = \App\Models\Document::where('contractor_id', $contractor->id)
                    ->orderBy('created_at', 'desc')
                    ->limit(5)
                    ->get();
            @endphp
            
            @if($recentDocuments->isEmpty())
                <div class="text-gray-500 p-4 bg-gray-50 rounded">
                    No documents found.
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Document Name</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Folder</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Uploaded On</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($recentDocuments as $document)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $document->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $document->file_type }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($document->folder)
                                            {{ $document->folder->name }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($document->document_status === 'approved')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Approved</span>
                                        @elseif($document->document_status === 'pending' || $document->document_status === null)
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                                        @elseif($document->document_status === 'rejected')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Rejected</span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">{{ $document->document_status }}</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $document->created_at->format('M d, Y') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('admin.documents.preview', $document) }}" class="bg-indigo-100 hover:bg-indigo-200 text-indigo-700 px-3 py-1 rounded text-sm mr-2" target="_blank">
                                            <i class="fas fa-eye mr-1"></i> View
                                        </a>
                                        <a href="{{ route('admin.documents.download', $document) }}" class="bg-blue-100 hover:bg-blue-200 text-blue-700 px-3 py-1 rounded text-sm">
                                            <i class="fas fa-download mr-1"></i> Download
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection 