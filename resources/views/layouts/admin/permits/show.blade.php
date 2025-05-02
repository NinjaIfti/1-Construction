@extends('layouts.admin.dashboard')

@section('content')
<div>
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold">Permit Details</h2>
            <p class="text-gray-500">{{ $permit->permit_number }}</p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('admin.permits.contractor', $permit->project->user) }}" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-md text-gray-700 flex items-center">
                <i class="fas fa-user mr-2"></i> Back to Contractor Permits
            </a>
            <a href="{{ route('admin.permits.index') }}" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-md text-gray-700 flex items-center">
                <i class="fas fa-list mr-2"></i> All Permits
            </a>
        </div>
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
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <!-- Permit Information -->
        <div class="md:col-span-2 bg-white shadow overflow-hidden rounded-lg">
            <div class="px-4 py-5 sm:px-6 bg-gray-50 flex justify-between items-center">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Permit Information
                </h3>
                <button onclick="document.getElementById('status-modal').classList.remove('hidden')" class="inline-flex items-center px-3 py-1.5 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Update Status
                </button>
            </div>
            <div class="border-t border-gray-200">
                <dl>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Permit Number
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $permit->permit_number }}
                        </dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Type
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $permit->type }}
                        </dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Status
                        </dt>
                        <dd class="mt-1 text-sm sm:mt-0 sm:col-span-2">
                            @if($permit->status == 'Pending')
                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    Pending
                                </span>
                            @elseif($permit->status == 'In Review')
                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    In Review
                                </span>
                            @elseif($permit->status == 'Approved')
                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Approved
                                </span>
                            @elseif($permit->status == 'Rejected')
                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                    Rejected
                                </span>
                            @endif
                        </dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Submission Date
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $permit->submission_date ? $permit->submission_date->format('F j, Y') : 'N/A' }}
                        </dd>
                    </div>
                    @if($permit->approval_date)
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Approval Date
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $permit->approval_date->format('F j, Y') }}
                        </dd>
                    </div>
                    @endif
                    @if($permit->expiration_date)
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Expiration Date
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $permit->expiration_date->format('F j, Y') }}
                        </dd>
                    </div>
                    @endif
                    @if($permit->admin_notes)
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Admin Notes
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $permit->admin_notes }}
                        </dd>
                    </div>
                    @endif
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Description
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $permit->description ?: 'No description provided.' }}
                        </dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Documents
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            @if($permit->documents->count() > 0)
                                <ul class="border border-gray-200 rounded-md divide-y divide-gray-200">
                                    @foreach($permit->documents as $document)
                                        <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                                            <div class="w-0 flex-1 flex items-center">
                                                @if(in_array(pathinfo($document->name, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                                    <svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
                                                    </svg>
                                                @elseif(in_array(pathinfo($document->name, PATHINFO_EXTENSION), ['pdf']))
                                                    <svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd" />
                                                    </svg>
                                                @else
                                                    <svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd" />
                                                    </svg>
                                                @endif
                                                <span class="ml-2 flex-1 w-0 truncate">
                                                    {{ $document->name }}
                                                </span>
                                            </div>
                                            <div class="ml-4 flex-shrink-0 flex space-x-2">
                                                <a href="{{ route('documents.download', $document) }}" class="font-medium text-blue-600 hover:text-blue-500">
                                                    Download
                                                </a>
                                                @if(in_array(pathinfo($document->name, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif', 'pdf']))
                                                    <a href="{{ route('documents.preview', $document) }}" target="_blank" class="font-medium text-blue-600 hover:text-blue-500">
                                                        Preview
                                                    </a>
                                                @endif
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-gray-500 text-sm">No documents attached.</p>
                            @endif
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
        
        <!-- Contractor Information -->
        <div class="bg-white shadow overflow-hidden rounded-lg">
            <div class="px-4 py-5 sm:px-6 bg-gray-50">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Contractor Information
                </h3>
            </div>
            <div class="border-t border-gray-200">
                <dl>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Name
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $permit->project->user->name }}
                        </dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Company
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $permit->project->user->company_name ?? 'N/A' }}
                        </dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Email
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $permit->project->user->email }}
                        </dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Phone
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $permit->project->user->phone ?? 'N/A' }}
                        </dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Project
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $permit->project->name }}
                            <div class="text-xs text-gray-500 mt-1">{{ $permit->project->address }}</div>
                        </dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:px-6">
                        <div class="flex justify-between">
                            <a href="{{ route('admin.contractors.show', $permit->project->user) }}" class="inline-flex items-center px-3 py-1.5 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                View Contractor Profile
                            </a>
                            <a href="{{ route('admin.messages.create') }}?recipient_id={{ $permit->project->user->id }}" class="inline-flex items-center px-3 py-1.5 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Message Contractor
                            </a>
                        </div>
                    </div>
                </dl>
            </div>
        </div>
    </div>
    
    <!-- Comments Section -->
    <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-6">
        <div class="px-4 py-5 sm:px-6 bg-gray-50">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                Comments
            </h3>
        </div>
        
        <div class="border-t border-gray-200 divide-y divide-gray-200">
            @forelse($permit->comments as $comment)
                <div class="px-4 py-4">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center">
                                    <span class="text-gray-700 font-medium">{{ substr($comment->user->name, 0, 1) }}</span>
                                </div>
                            </div>
                            <div class="ml-3">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $comment->user->name }}
                                    @if($comment->user->isAdmin())
                                        <span class="ml-1 px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                            Admin
                                        </span>
                                    @else
                                        <span class="ml-1 px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Contractor
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="text-sm text-gray-500">
                            {{ $comment->created_at->diffForHumans() }}
                        </div>
                    </div>
                    <div class="mt-2 text-sm text-gray-700">
                        <p>{{ $comment->content }}</p>
                    </div>
                </div>
            @empty
                <div class="px-4 py-4 text-sm text-gray-500">
                    No comments yet.
                </div>
            @endforelse
        </div>
        
        <!-- Add Comment Form -->
        <div class="border-t border-gray-200 px-4 py-4">
            <form action="{{ route('admin.permits.comments.store', $permit) }}" method="POST">
                @csrf
                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700">Add a comment</label>
                    <div class="mt-1">
                        <textarea id="content" name="content" rows="3" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Type your message here..."></textarea>
                    </div>
                </div>
                <div class="mt-3 flex justify-end">
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Status Update Modal -->
    <div id="status-modal" class="hidden fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg max-w-md w-full p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold">Update Permit Status</h3>
                <button onclick="document.getElementById('status-modal').classList.add('hidden'); return false;" class="text-gray-400 hover:text-gray-500">
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
                    <button type="button" onclick="document.getElementById('status-modal').classList.add('hidden'); return false;" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <script>
        // Show/hide expiration date field based on status
        document.addEventListener('DOMContentLoaded', function() {
            const statusSelect = document.getElementById('status');
            statusSelect.addEventListener('change', function() {
                const container = document.getElementById('expiration-date-container');
                if (this.value === 'Approved') {
                    container.classList.remove('hidden');
                } else {
                    container.classList.add('hidden');
                }
            });
        });
    </script>
</div>
@endsection 