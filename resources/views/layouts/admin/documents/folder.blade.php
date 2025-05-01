@extends('layouts.admin.dashboard')

@section('content')
<div class="animate-fadeIn">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl md:text-2xl font-bold">{{ $contractor->name }} > {{ $folder->name }}</h2>
        <a href="{{ route('admin.documents.upload') }}?contractor_id={{ $contractor->id }}&folder_id={{ $folder->id }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
            <i class="fas fa-file-upload mr-2"></i> Upload to Folder
        </a>
    </div>
    
    <div class="bg-white rounded-lg shadow p-4">
        <!-- Breadcrumb navigation -->
        <div class="mb-4 flex items-center text-sm text-gray-500">
            <a href="{{ route('admin.documents.folders', ['contractor_id' => $contractor->id]) }}" class="hover:text-blue-500">
                <i class="fas fa-home mr-1"></i> Root
            </a>
            
            @foreach($breadcrumbs as $breadcrumb)
                <span class="mx-2">/</span>
                @if($breadcrumb->id === $folder->id)
                    <span class="font-medium text-gray-700">{{ $breadcrumb->name }}</span>
                @else
                    <a href="{{ route('admin.documents.folder', $breadcrumb) }}" class="hover:text-blue-500">
                        {{ $breadcrumb->name }}
                    </a>
                @endif
            @endforeach
        </div>
        
        <!-- Create subfolder section -->
        <div class="mb-6 p-4 bg-gray-50 rounded-lg">
            <form method="POST" action="{{ route('admin.documents.create-folder') }}" class="flex items-center">
                @csrf
                <input type="hidden" name="contractor_id" value="{{ $contractor->id }}">
                <input type="hidden" name="parent_folder" value="{{ $folder->id }}">
                <input type="text" name="folder_name" placeholder="New subfolder name" class="border rounded px-4 py-2 mr-2" required>
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-3 py-2 rounded">
                    <i class="fas fa-folder-plus mr-1"></i> Create Subfolder
                </button>
            </form>
        </div>
        
        <!-- Subfolders section -->
        @if($folder->subfolders->count() > 0)
            <h3 class="text-lg font-medium mb-4">Subfolders</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                @foreach($folder->subfolders as $subfolder)
                    <div class="border rounded-lg p-4 hover:bg-gray-50">
                        <a href="{{ route('admin.documents.folder', $subfolder) }}" class="flex items-start">
                            <div class="text-yellow-500 mr-3">
                                <i class="fas fa-folder fa-2x"></i>
                            </div>
                            <div>
                                <h4 class="font-medium">{{ $subfolder->name }}</h4>
                                <div class="text-sm text-gray-500">
                                    {{ $subfolder->subfolders->count() }} subfolder(s), 
                                    {{ $subfolder->documents->count() }} document(s)
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
        
        <!-- Documents section -->
        <h3 class="text-lg font-medium mb-4">Documents in this folder</h3>
        
        @if($folder->documents->isEmpty())
            <div class="text-gray-500 p-4 bg-gray-50 rounded">
                No documents found in this folder.
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Document Name</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Size</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Uploaded On</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($folder->documents as $document)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $document->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $document->file_type }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $document->formatted_file_size }}</td>
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
                                    <a href="{{ route('admin.documents.download', $document) }}" class="bg-blue-100 hover:bg-blue-200 text-blue-700 px-3 py-1 rounded text-sm mr-2">
                                        <i class="fas fa-download mr-1"></i> Download
                                    </a>
                                    @if($document->document_status !== 'approved')
                                        <form method="POST" action="{{ route('admin.documents.approve', $document) }}" class="inline">
                                            @csrf
                                            <button type="submit" class="bg-green-100 hover:bg-green-200 text-green-700 px-3 py-1 rounded text-sm">
                                                <i class="fas fa-check mr-1"></i> Approve
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection 