@extends('layouts.admin.dashboard')

@section('content')
<div>
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold">Permits for {{ $contractor->name }}</h2>
            <p class="text-gray-500">{{ $contractor->company_name ?? 'No company' }} | {{ $contractor->email }}</p>
        </div>
        <a href="{{ route('admin.permits.index') }}" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-md text-gray-700 flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Back to All Permits
        </a>
    </div>
    
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
            <p>{{ session('error') }}</p>
        </div>
    @endif
    
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        @if($permits->count() > 0)
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Permit #
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Type
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Project
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Submission Date
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Documents
                        </th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($permits as $permit)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $permit->permit_number }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $permit->type }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $permit->project->name }}</div>
                                <div class="text-xs text-gray-500">{{ Str::limit($permit->project->address, 30) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($permit->status == 'Pending')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Pending
                                    </span>
                                @elseif($permit->status == 'In Review')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                        In Review
                                    </span>
                                @elseif($permit->status == 'Approved')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Approved
                                    </span>
                                @elseif($permit->status == 'Rejected')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        Rejected
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ $permit->submission_date ? $permit->submission_date->format('M d, Y') : 'N/A' }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $permit->documents->count() }} {{ Str::plural('document', $permit->documents->count()) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('admin.permits.show', $permit) }}" class="text-blue-600 hover:text-blue-900 mr-3">
                                    View
                                </a>
                                <a href="#" class="text-green-600 hover:text-green-900" onclick="document.getElementById('status-modal-{{ $permit->id }}').classList.remove('hidden'); return false;">
                                    Update Status
                                </a>
                                
                                <!-- Status Update Modal -->
                                <div id="status-modal-{{ $permit->id }}" class="hidden fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50">
                                    <div class="bg-white rounded-lg max-w-md w-full p-6">
                                        <div class="flex justify-between items-center mb-4">
                                            <h3 class="text-lg font-semibold">Update Permit Status</h3>
                                            <button onclick="document.getElementById('status-modal-{{ $permit->id }}').classList.add('hidden'); return false;" class="text-gray-400 hover:text-gray-500">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                        
                                        <form action="{{ route('admin.permits.update-status', $permit) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            
                                            <div class="mb-4">
                                                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                                <select id="status" name="status" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                                    <option value="Pending" {{ $permit->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="In Review" {{ $permit->status == 'In Review' ? 'selected' : '' }}>In Review</option>
                                                    <option value="Approved" {{ $permit->status == 'Approved' ? 'selected' : '' }}>Approved</option>
                                                    <option value="Rejected" {{ $permit->status == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                                                </select>
                                            </div>
                                            
                                            <div class="mb-4">
                                                <label for="admin_notes" class="block text-sm font-medium text-gray-700 mb-1">Admin Notes</label>
                                                <textarea id="admin_notes" name="admin_notes" rows="3" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">{{ $permit->admin_notes }}</textarea>
                                            </div>
                                            
                                            <div id="expiration-date-container" class="mb-4 {{ $permit->status != 'Approved' ? 'hidden' : '' }}">
                                                <label for="expiration_date" class="block text-sm font-medium text-gray-700 mb-1">Expiration Date</label>
                                                <input type="date" id="expiration_date" name="expiration_date" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ $permit->expiration_date ? $permit->expiration_date->format('Y-m-d') : '' }}">
                                            </div>
                                            
                                            <div class="flex justify-end space-x-3">
                                                <button type="button" onclick="document.getElementById('status-modal-{{ $permit->id }}').classList.add('hidden'); return false;" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                    Cancel
                                                </button>
                                                <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                    Save
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- End Status Update Modal -->
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
            <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                {{ $permits->links() }}
            </div>
        @else
            <div class="px-6 py-10 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No permits found</h3>
                <p class="mt-1 text-sm text-gray-500">This contractor has not submitted any permits yet.</p>
            </div>
        @endif
    </div>
</div>

<script>
    // Show/hide expiration date field based on status
    document.addEventListener('DOMContentLoaded', function() {
        const statusSelects = document.querySelectorAll('select[name="status"]');
        statusSelects.forEach(select => {
            select.addEventListener('change', function() {
                const container = this.closest('form').querySelector('[id^="expiration-date-container"]');
                if (this.value === 'Approved') {
                    container.classList.remove('hidden');
                } else {
                    container.classList.add('hidden');
                }
            });
        });
    });
</script>
@endsection 