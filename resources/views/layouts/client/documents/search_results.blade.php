@extends('layouts.client.dashboard')

@section('content')
<div class="container mx-auto p-4">
    <div class="mb-4 flex items-center">
        <a href="{{ route('client.documents.index') }}" class="bg-gray-500 text-white px-3 py-1 rounded mr-4">
            <i class="fas fa-arrow-left mr-1"></i> Back to Documents
        </a>
        <h2 class="text-xl font-bold">Search Results</h2>
    </div>

    <div class="mb-4">
        <form action="{{ route('client.documents.search') }}" method="GET" class="flex">
            <input type="text" name="query" value="{{ $query }}" class="border rounded-l p-2 flex-grow" placeholder="Search documents..." required>
            <button type="submit" class="bg-blue-500 text-white px-4 rounded-r">
                <i class="fas fa-search"></i>
            </button>
        </form>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-3 border-b bg-gray-50">
            <span class="font-bold">Found {{ $documents->count() }} document(s) for "{{ $query }}"</span>
        </div>
        
        @if($documents->count() > 0)
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
                            @if($document->description)
                                <div class="text-sm text-gray-600">{{ \Illuminate\Support\Str::limit($document->description, 100) }}</div>
                            @endif
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
        @else
            <div class="p-8 text-center">
                <i class="fas fa-search text-gray-400 text-5xl mb-4"></i>
                <h3 class="text-xl font-medium text-gray-600 mb-2">No Documents Found</h3>
                <p class="text-gray-500">Try a different search term or browse all documents.</p>
            </div>
        @endif
    </div>
</div>
@endsection