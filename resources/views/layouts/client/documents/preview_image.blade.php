@extends('layouts.client.dashboard')

@section('content')
<div class="container mx-auto p-4">
    <div class="mb-4 flex items-center">
        <a href="{{ URL::previous() }}" class="bg-gray-500 text-white px-3 py-1 rounded mr-4">
            <i class="fas fa-arrow-left mr-1"></i> Back
        </a>
        <h2 class="text-xl font-bold">{{ $document->name }}</h2>
        <div class="ml-auto">
            <a href="{{ route('client.documents.download', $document) }}" class="bg-blue-500 text-white px-3 py-1 rounded">
                <i class="fas fa-download mr-1"></i> Download
            </a>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-4">
        @if($document->description)
            <div class="mb-4 text-gray-700">
                <strong>Description:</strong> {{ $document->description }}
            </div>
        @endif
        
        <div class="mb-2 text-sm text-gray-600">
            Uploaded on {{ $document->created_at->format('M d, Y') }} | {{ $document->formatted_file_size }}
        </div>
        
        <div class="border rounded-lg p-4 flex justify-center">
            <img src="{{ $url }}" alt="{{ $document->name }}" class="max-w-full max-h-screen object-contain">
        </div>
    </div>
</div>
@endsection