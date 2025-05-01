@extends('layouts.admin.dashboard')

@section('content')
<div class="animate-fadeIn">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl md:text-2xl font-bold">Documents</h2>
        <a href="{{ route('admin.documents.upload') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
            <i class="fas fa-file-upload mr-2"></i> Upload Document
        </a>
    </div>
    
    <div class="bg-white rounded-lg shadow p-4">
        <div class="flex flex-wrap gap-4 mb-6">            
            <div class="relative flex-grow">
                <input type="text" placeholder="Search documents..." class="border rounded px-4 py-2 pl-10 w-full" id="searchInput">
                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
            </div>
            
            <div class="w-full md:w-auto">
                <!-- Filter by contractor dropdown -->
                <select class="border rounded px-4 py-2" id="contractorFilter">
                    <option value="">All Contractors</option>
                    <!-- Populated dynamically -->
                </select>
            </div>
            
            <div class="w-full md:w-auto">
                <!-- Filter by category dropdown -->
                <select class="border rounded px-4 py-2" id="categoryFilter">
                    <option value="">All Categories</option>
                    <option value="verification">Verification</option>
                    <option value="permits">Permits</option>
                    <option value="contracts">Contracts</option>
                    <option value="invoices">Invoices</option>
                    <option value="general">General</option>
                </select>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
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
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $document->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $document->file_type }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($document->permit && $document->permit->contractor)
                                    {{ $document->permit->contractor->name }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $path = $document->file_path;
                                    // Remove 'public/' prefix if exists
                                    $path = str_replace('public/', '', $path);
                                    // Get folder path without filename
                                    $folderPath = dirname($path);
                                    // Format nicely
                                    $folderPath = str_replace('/', ' > ', $folderPath);
                                @endphp
                                {{ $folderPath }}
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
        
        @if(count($documents) === 0)
        <div class="text-center py-4">
            <p class="text-gray-500">No documents found</p>
        </div>
        @endif
        
        <div class="mt-4">
            {{ $documents->links() }}
        </div>
    </div>
    
    <!-- Folder Browser Section (Optional) -->
    <div class="bg-white rounded-lg shadow p-4 mt-6">
        <h3 class="text-lg font-medium mb-4">Document Folders</h3>
        
        <p class="text-gray-500 mb-4">Browse documents by contractor folder structure.</p>
        
        <div class="flex items-center mb-4">
            <select class="border rounded px-4 py-2 mr-2" id="folderContractorSelect">
                <option value="">Select Contractor</option>
                <!-- Populated dynamically -->
            </select>
            
            <button class="bg-gray-200 hover:bg-gray-300 px-3 py-2 rounded">
                <i class="fas fa-folder-open mr-1"></i> Browse
            </button>
        </div>
        
        <div class="flex-1 overflow-auto bg-gray-50 rounded-lg p-4 min-h-32 max-h-64">
            <div class="text-gray-500 text-center">
                Select a contractor to browse their document folders
            </div>
            
            <!-- Folder tree will be populated here -->
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const tbody = document.getElementById('documentsTable');
    const rows = tbody.querySelectorAll('tr');

    searchInput.addEventListener('keyup', function() {
        const query = this.value.toLowerCase();
        
        rows.forEach(row => {
            let found = false;
            const cells = row.querySelectorAll('td');
            
            cells.forEach(cell => {
                if (cell.textContent.toLowerCase().indexOf(query) > -1) {
                    found = true;
                }
            });
            
            row.style.display = found ? '' : 'none';
        });
    });
    
    // Add filter functionality for contractor and category dropdowns
    const contractorFilter = document.getElementById('contractorFilter');
    const categoryFilter = document.getElementById('categoryFilter');
    
    // Populate contractor dropdown
    const contractors = new Set();
    rows.forEach(row => {
        const contractorCell = row.querySelectorAll('td')[2];
        if (contractorCell && contractorCell.textContent.trim() !== 'N/A') {
            contractors.add(contractorCell.textContent.trim());
        }
    });
    
    contractors.forEach(contractor => {
        const option = document.createElement('option');
        option.value = contractor;
        option.textContent = contractor;
        contractorFilter.appendChild(option);
        
        // Also add to folder browser dropdown
        const folderOption = option.cloneNode(true);
        document.getElementById('folderContractorSelect').appendChild(folderOption);
    });
    
    // Filter functionality
    function filterRows() {
        const contractorValue = contractorFilter.value.toLowerCase();
        const categoryValue = categoryFilter.value.toLowerCase();
        
        rows.forEach(row => {
            const cells = row.querySelectorAll('td');
            const rowContractor = cells[2].textContent.toLowerCase();
            const rowPath = cells[3].textContent.toLowerCase();
            
            let showRow = true;
            
            if (contractorValue && rowContractor.indexOf(contractorValue) === -1) {
                showRow = false;
            }
            
            if (categoryValue && rowPath.indexOf(categoryValue) === -1) {
                showRow = false;
            }
            
            row.style.display = showRow ? '' : 'none';
        });
    }
    
    contractorFilter.addEventListener('change', filterRows);
    categoryFilter.addEventListener('change', filterRows);
});
</script>
@endsection 