@extends('layouts.admin.dashboard')

@section('content')
<div class="animate-fadeIn">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl md:text-2xl font-bold">Document Details</h2>
        <a href="{{ route('admin.documents.index') }}" class="text-blue-500 hover:underline flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Back to Documents
        </a>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Document Information Card -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-navy border-b pb-2 mb-4">Document Information</h3>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-gray-500 text-sm">Filename</label>
                        <div class="font-medium">{{ $document->original_filename }}</div>
                    </div>
                    
                    <div>
                        <label class="block text-gray-500 text-sm">Type</label>
                        <div class="font-medium">{{ $document->document_type }}</div>
                    </div>
                    
                    <div>
                        <label class="block text-gray-500 text-sm">Status</label>
                        <div>
                            @if($document->document_status === 'approved')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Approved</span>
                            @elseif($document->document_status === 'pending' || $document->document_status === null)
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                            @elseif($document->document_status === 'rejected')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Rejected</span>
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">{{ $document->document_status }}</span>
                            @endif
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-gray-500 text-sm">Uploaded On</label>
                        <div class="font-medium">{{ $document->created_at->format('F d, Y h:i A') }}</div>
                    </div>
                    
                    <div>
                        <label class="block text-gray-500 text-sm">File Size</label>
                        <div class="font-medium">{{ number_format($document->file_size / 1024, 2) }} KB</div>
                    </div>
                    
                    <div>
                        <label class="block text-gray-500 text-sm">Uploaded By</label>
                        <div class="font-medium">{{ $document->user->name ?? 'Unknown' }}</div>
                    </div>
                </div>
                
                <div class="mt-6 flex flex-wrap gap-3">
                    <a href="{{ route('admin.documents.download', $document) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                        <i class="fas fa-download mr-2"></i> Download
                    </a>
                    
                    @if($document->document_status === 'pending' || $document->document_status === null)
                    <form action="{{ route('admin.documents.approve', $document) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                            <i class="fas fa-check mr-2"></i> Approve
                        </button>
                    </form>
                    
                    <form action="{{ route('admin.documents.reject', $document) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                            <i class="fas fa-times mr-2"></i> Reject
                        </button>
                    </form>
                    @endif
                </div>
            </div>
            
            @if($document->permit)
            <div class="bg-white rounded-lg shadow p-6 mt-6">
                <h3 class="text-lg font-semibold text-navy border-b pb-2 mb-4">Related Permit</h3>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-gray-500 text-sm">Permit Number</label>
                        <div class="font-medium">{{ $document->permit->permit_number }}</div>
                    </div>
                    
                    <div>
                        <label class="block text-gray-500 text-sm">Project</label>
                        <div class="font-medium">{{ $document->permit->project->name ?? 'N/A' }}</div>
                    </div>
                    
                    <div>
                        <label class="block text-gray-500 text-sm">Status</label>
                        <div class="font-medium">{{ ucfirst($document->permit->status) }}</div>
                    </div>
                </div>
            </div>
            @endif
        </div>
        
        <!-- Document Preview -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow h-full">
                <div class="p-4 border-b">
                    <h3 class="font-medium">Document Preview</h3>
                </div>
                
                <div class="p-4 flex items-center justify-center min-h-[500px]">
                    @php
                        $extension = pathinfo($document->original_filename, PATHINFO_EXTENSION);
                        $isPdf = strtolower($extension) === 'pdf';
                        $isImage = in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif']);
                    @endphp
                    
                    @if($isPdf)
                        <iframe src="{{ route('admin.documents.preview', $document) }}" class="w-full h-[600px]"></iframe>
                    @elseif($isImage)
                        <img src="{{ route('admin.documents.preview', $document) }}" alt="Document Preview" class="max-w-full max-h-[600px]">
                    @else
                        <div class="text-center p-6">
                            <i class="fas fa-file-alt text-gray-300 text-6xl mb-4"></i>
                            <p class="text-gray-500">Preview not available for this file type</p>
                            <a href="{{ route('admin.documents.download', $document) }}" class="text-blue-500 hover:underline mt-4 inline-block">
                                <i class="fas fa-download mr-2"></i> Download to view
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 