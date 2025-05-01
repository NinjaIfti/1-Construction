@extends('layouts.admin.dashboard')

@section('content')
<div class="animate-fadeIn">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <div>
            <h2 class="text-xl md:text-2xl font-bold text-gray-800">Document Management</h2>
            <p class="text-gray-600 mt-1">View, organize and manage all contractor documents</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.documents.index') }}" class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-md flex items-center">
                <i class="fas fa-sync-alt mr-2"></i> Refresh
            </a>
            <a href="{{ route('admin.documents.upload') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md flex items-center">
                <i class="fas fa-file-upload mr-2"></i> Upload Document
            </a>
        </div>
    </div>
    
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <!-- Total Documents -->
        <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-5">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                    <i class="fas fa-file-alt text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Documents</p>
                    <p class="text-2xl font-semibold text-gray-800">{{ App\Models\Document::count() }}</p>
                </div>
            </div>
        </div>
        
        <!-- Pending Documents -->
        <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-5">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600 mr-4">
                    <i class="fas fa-clock text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Pending Review</p>
                    <p class="text-2xl font-semibold text-gray-800">{{ App\Models\Document::where('document_status', 'pending')->orWhereNull('document_status')->count() }}</p>
                </div>
            </div>
        </div>
        
        <!-- Approved Documents -->
        <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-5">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                    <i class="fas fa-check-circle text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Approved</p>
                    <p class="text-2xl font-semibold text-gray-800">{{ App\Models\Document::where('document_status', 'approved')->count() }}</p>
                </div>
            </div>
        </div>
        
        <!-- Rejected Documents -->
        <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-5">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-red-100 text-red-600 mr-4">
                    <i class="fas fa-times-circle text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Rejected</p>
                    <p class="text-2xl font-semibold text-gray-800">{{ App\Models\Document::where('document_status', 'rejected')->count() }}</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-5 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-800">Document Library</h3>
        </div>
        
        <form method="GET" action="{{ route('admin.documents.index') }}" id="filterForm" class="p-5 bg-gray-50 border-b border-gray-200">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="flex-grow">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        <input 
                            type="text" 
                            name="search" 
                            placeholder="Search documents..." 
                            class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                            value="{{ request('search') }}"
                        >
                    </div>
                </div>
                
                <div class="w-full md:w-64">
                    <label for="contractorFilter" class="block text-sm font-medium text-gray-700 mb-1">Contractor</label>
                    <select 
                        class="block w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                        id="contractorFilter" 
                        name="contractor_id" 
                        onchange="this.form.submit()"
                    >
                        <option value="">All Contractors</option>
                        @foreach($contractors as $contractor)
                            <option value="{{ $contractor->id }}" @if(request('contractor_id') == $contractor->id) selected @endif>
                                {{ $contractor->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="w-full md:w-64">
                    <label for="categoryFilter" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                    <select 
                        class="block w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                        id="categoryFilter" 
                        name="category" 
                        onchange="this.form.submit()"
                    >
                        <option value="">All Categories</option>
                        <option value="permits" @if(request('category') == 'permits') selected @endif>Permits</option>
                        <option value="site_plans" @if(request('category') == 'site_plans') selected @endif>Site Plans</option>
                        <option value="licenses" @if(request('category') == 'licenses') selected @endif>Licenses</option>
                        <option value="credentials" @if(request('category') == 'credentials') selected @endif>Credentials</option>
                        <option value="contracts" @if(request('category') == 'contracts') selected @endif>Contracts</option>
                        <option value="invoices" @if(request('category') == 'invoices') selected @endif>Invoices</option>
                    </select>
                </div>
                
                <div class="w-full md:w-auto md:self-end">
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
                        <i class="fas fa-filter mr-2"></i> Apply Filters
                    </button>
                </div>
            </div>
        </form>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Document Name</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contractor</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Folder Path</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Uploaded On</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="documentsTable">
                    @foreach($documents as $document)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-800">
                                {{ $document->name }}
                                <p class="text-xs text-gray-500 mt-1 font-normal truncate max-w-sm">
                                    {{ $document->description ?? 'No description' }}
                                </p>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs rounded bg-gray-100 text-gray-800">
                                    {{ Str::upper(Str::afterLast($document->file_type, '/')) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($document->contractor)
                                    <a href="{{ route('admin.documents.folders', ['contractor_id' => $document->contractor->id]) }}" class="text-blue-600 hover:text-blue-800">
                                        {{ $document->contractor->name }}
                                    </a>
                                @elseif($document->permit && $document->permit->contractor)
                                    {{ $document->permit->contractor->name }}
                                @else
                                    <span class="text-gray-400">N/A</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                @php
                                    $path = $document->file_path;
                                    // Remove 'public/' prefix if exists
                                    $path = str_replace('public/', '', $path);
                                    // Get folder path without filename
                                    $folderPath = dirname($path);
                                    // Format nicely
                                    $folderPath = str_replace('/', ' > ', $folderPath);
                                @endphp
                                <span class="max-w-xs truncate block">{{ $folderPath }}</span>
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
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $document->created_at->format('M d, Y') }}
                                <p class="text-xs">{{ $document->created_at->diffForHumans() }}</p>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.documents.preview', $document) }}" class="bg-indigo-100 hover:bg-indigo-200 text-indigo-700 px-3 py-1 rounded-md text-sm inline-flex items-center" target="_blank">
                                        <i class="fas fa-eye mr-1"></i> View
                                    </a>
                                    <a href="{{ route('admin.documents.download', $document) }}" class="bg-blue-100 hover:bg-blue-200 text-blue-700 px-3 py-1 rounded-md text-sm inline-flex items-center">
                                        <i class="fas fa-download mr-1"></i> Download
                                    </a>
                                    <div class="relative" x-data="{ open: false }">
                                        <button @click="open = !open" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-2 py-1 rounded-md">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <div x-show="open" @click.away="open = false" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-10">
                                            <div class="py-1">
                                                @if($document->document_status !== 'approved')
                                                    <form method="POST" action="{{ route('admin.documents.approve', $document) }}">
                                                        @csrf
                                                        <button type="submit" class="w-full text-left block px-4 py-2 text-sm text-green-700 hover:bg-green-100">
                                                            <i class="fas fa-check mr-2"></i> Approve
                                                        </button>
                                                    </form>
                                                @endif
                                                @if($document->document_status !== 'rejected')
                                                    <form method="POST" action="{{ route('admin.documents.reject', $document) }}">
                                                        @csrf
                                                        <button type="submit" class="w-full text-left block px-4 py-2 text-sm text-red-700 hover:bg-red-100">
                                                            <i class="fas fa-times mr-2"></i> Reject
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        @if(count($documents) === 0)
            <div class="text-center py-8">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 text-gray-400 mb-4">
                    <i class="fas fa-file-alt text-2xl"></i>
                </div>
                <p class="text-gray-500 mb-2">No documents found</p>
                <p class="text-sm text-gray-400">Try adjusting your search or filter criteria</p>
            </div>
        @endif
        
        <div class="p-5 border-t border-gray-200">
            {{ $documents->links() }}
        </div>
    </div>
    
    <!-- Folder Browser Section -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden mt-6">
        <div class="p-5 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-800">Document Folders</h3>
            <p class="text-gray-500 mt-1">Browse documents organized by contractor folder structure</p>
        </div>
        
        <div class="p-5">
            <form method="GET" action="{{ route('admin.documents.folders') }}" id="folderBrowserForm" class="flex flex-col md:flex-row gap-3">
                <div class="flex-grow">
                    <select class="block w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" id="folderContractorSelect" name="contractor_id">
                        <option value="">Select Contractor</option>
                        @foreach($contractors as $contractor)
                            <option value="{{ $contractor->id }}">{{ $contractor->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div>
                    <button type="submit" class="w-full md:w-auto bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
                        <i class="fas fa-folder-open mr-2"></i> Browse Folders
                    </button>
                </div>
            </form>
        </div>
        
        <div class="p-5 bg-gray-50 border-t border-gray-200 min-h-[150px]">
            <div class="flex flex-col items-center justify-center h-full text-center">
                <div class="rounded-full bg-gray-100 text-gray-400 p-4 mb-3">
                    <i class="fas fa-folder text-xl"></i>
                </div>
                <p class="text-gray-500">Select a contractor to browse their document folders</p>
            </div>
        </div>
    </div>
    
    <!-- Recently Added Section -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden mt-6">
        <div class="p-5 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-800">Recently Added Documents</h3>
            <p class="text-gray-500 mt-1">The latest documents uploaded to the system</p>
        </div>
        
        <div class="p-5">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @php
                    $recentDocs = App\Models\Document::with(['contractor', 'folder'])
                        ->orderBy('created_at', 'desc')
                        ->limit(3)
                        ->get();
                @endphp
                
                @forelse($recentDocs as $doc)
                    <div class="border border-gray-200 rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                        <div class="p-5">
                            <div class="flex items-start">
                                <div class="p-3 rounded-lg mr-4 
                                    @if($doc->isPdf()) bg-red-100 text-red-600
                                    @elseif($doc->isImage()) bg-blue-100 text-blue-600
                                    @else bg-gray-100 text-gray-600 @endif">
                                    <i class="fas fa-file-alt text-xl"></i>
                                </div>
                                <div class="flex-grow min-w-0">
                                    <h4 class="font-medium text-gray-800 truncate">{{ $doc->name }}</h4>
                                    <p class="text-sm text-gray-500 mt-1">
                                        {{ $doc->contractor->name ?? 'Unknown Contractor' }}
                                    </p>
                                    <p class="text-xs text-gray-400 mt-1">
                                        Added {{ $doc->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                            <div class="mt-4 flex justify-end space-x-2">
                                <a href="{{ route('admin.documents.preview', $doc) }}" class="text-indigo-600 hover:text-indigo-800 text-sm" target="_blank">
                                    <i class="fas fa-eye mr-1"></i> View
                                </a>
                                <a href="{{ route('admin.documents.download', $doc) }}" class="text-blue-600 hover:text-blue-800 text-sm">
                                    <i class="fas fa-download mr-1"></i> Download
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-8">
                        <p class="text-gray-500">No recent documents found</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.querySelector('input[name="search"]');
    const tbody = document.getElementById('documentsTable');
    const rows = tbody.querySelectorAll('tr');

    searchInput.addEventListener('keyup', function(e) {
        const query = this.value.toLowerCase();
        
        // Only filter client-side if user hasn't pressed Enter yet
        if (e.key !== 'Enter') {
            rows.forEach(row => {
                let found = false;
                const cells = row.querySelectorAll('td');
                
                cells.forEach(cell => {
                    if (cell.textContent.toLowerCase().includes(query)) {
                        found = true;
                    }
                });
                
                row.style.display = found ? '' : 'none';
            });
        }
    });
    
    // Submit form on Enter
    searchInput.addEventListener('keydown', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            document.getElementById('filterForm').submit();
        }
    });
});
</script>
@endpush

@endsection 