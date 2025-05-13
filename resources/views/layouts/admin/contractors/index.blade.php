@extends('layouts.admin.dashboard')

@section('content')
<div class="animate-fadeIn">
    <h2 class="text-xl md:text-2xl font-bold mb-6">Contractors</h2>
    <div class="bg-white rounded-lg shadow p-4">
        <div class="flex flex-wrap gap-4 mb-6">
            <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded" onclick="window.location.href='{{ route('admin.contractors.create') }}'">
                <i class="fas fa-user-plus mr-2"></i> Add Contractor
            </button>
            <div class="flex-grow"></div>
            <div class="relative">
                <input type="text" placeholder="Search contractors..." class="border rounded px-4 py-2 pl-10 w-full" id="searchInput">
                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Company</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Verification Status</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Joined On</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="contractorsTable">
                    @foreach($contractors as $contractor)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $contractor->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $contractor->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $contractor->company_name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($contractor->verification_status === 'approved')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Verified</span>
                                @elseif($contractor->verification_status === 'under_review')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Under Review</span>
                                @elseif($contractor->verification_status === 'rejected')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Rejected</span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">Missing Documents</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $contractor->created_at->format('M d, Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('admin.verifications.show', $contractor) }}" class="bg-indigo-100 hover:bg-indigo-200 text-indigo-700 px-3 py-1 rounded text-sm mr-2">
                                    <i class="fas fa-clipboard-check mr-1"></i> Review
                                </a>
                                <a href="{{ route('admin.contractors.show', $contractor->id) }}" class="bg-blue-100 hover:bg-blue-200 text-blue-700 px-3 py-1 rounded text-sm mr-2">
                                    <i class="fas fa-eye mr-1"></i> View
                                </a>
                                <form action="{{ route('admin.contractors.force-delete', $contractor->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this contractor? This will delete all related data including projects, permits, documents, and invoices.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-100 hover:bg-red-200 text-red-700 px-3 py-1 rounded text-sm">
                                        <i class="fas fa-trash mr-1"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        @if(count($contractors) === 0)
        <div class="text-center py-4">
            <p class="text-gray-500">No contractors found</p>
        </div>
        @endif
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const tbody = document.getElementById('contractorsTable');
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
});
</script>
@endsection 