@extends('layouts.admin.dashboard')

@section('content')
<div class="animate-fadeIn">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl md:text-2xl font-bold">Update Verification Status</h2>
        <a href="{{ route('admin.verifications.show', $contractor->id) }}" class="text-blue-500 hover:underline flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Back to Review
        </a>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center mb-6">
            <div class="flex-shrink-0 h-16 w-16 bg-gray-200 rounded-full flex items-center justify-center mr-4">
                <i class="fas fa-user text-gray-500 text-xl"></i>
            </div>
            <div>
                <h3 class="text-lg font-semibold">{{ $contractor->name }}</h3>
                <p class="text-gray-600">{{ $contractor->company_name ?? 'No Company Name' }}</p>
            </div>
        </div>
        
        <form action="{{ route('admin.verifications.update', $contractor->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <!-- Current Status -->
            <div class="mb-6">
                <h4 class="font-medium text-gray-700 mb-2">Current Status</h4>
                <div class="p-4 rounded-lg {{ $contractor->verification_status == 'approved' ? 'bg-green-50 text-green-700' : ($contractor->verification_status == 'rejected' ? 'bg-red-50 text-red-700' : 'bg-yellow-50 text-yellow-700') }}">
                    <div class="flex items-center">
                        @if($contractor->verification_status == 'approved')
                            <i class="fas fa-check-circle mr-2"></i>
                            <span><strong>Verified</strong> on {{ $contractor->verified_at ? $contractor->verified_at->format('F d, Y') : 'unknown date' }}</span>
                        @elseif($contractor->verification_status == 'rejected')
                            <i class="fas fa-times-circle mr-2"></i>
                            <span><strong>Rejected</strong> - Documents need to be resubmitted</span>
                        @else
                            <i class="fas fa-clock mr-2"></i>
                            <span><strong>Pending Review</strong> - Waiting for admin verification</span>
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- Update Status Section -->
            <div class="mb-6">
                <h4 class="font-medium text-gray-700 mb-2">Update Status</h4>
                <div class="space-y-4">
                    <div class="flex items-center">
                        <input type="radio" name="verification_status" id="status_verified" value="verified" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                        <label for="status_verified" class="ml-2 block text-gray-700">
                            Verify Contractor
                            <p class="text-xs text-gray-500">Approve and grant full access to the platform</p>
                        </label>
                    </div>
                    
                    <div class="flex items-center">
                        <input type="radio" name="verification_status" id="status_rejected" value="rejected" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                        <label for="status_rejected" class="ml-2 block text-gray-700">
                            Reject Verification
                            <p class="text-xs text-gray-500">Reject documents and request resubmission</p>
                        </label>
                    </div>
                    
                    <div class="flex items-center">
                        <input type="radio" name="verification_status" id="status_pending" value="pending" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                        <label for="status_pending" class="ml-2 block text-gray-700">
                            Mark as Pending
                            <p class="text-xs text-gray-500">Reset to pending status</p>
                        </label>
                    </div>
                </div>
                @error('verification_status')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Feedback -->
            <div class="mb-6">
                <label for="feedback" class="block font-medium text-gray-700 mb-2">Feedback for Contractor</label>
                <textarea id="feedback" name="feedback" rows="4" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Provide feedback to the contractor regarding their verification status...">{{ old('feedback', $contractor->admin_feedback) }}</textarea>
                <p class="mt-1 text-xs text-gray-500">This feedback will be visible to the contractor.</p>
                @error('feedback')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Notify Contractor -->
            <div class="mb-6">
                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <input id="notify_contractor" name="notify_contractor" type="checkbox" value="1" checked class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="notify_contractor" class="font-medium text-gray-700">Notify Contractor via Email</label>
                        <p class="text-gray-500">Send an email notification to the contractor regarding their updated verification status.</p>
                    </div>
                </div>
            </div>
            
            <!-- Submit Buttons -->
            <div class="flex justify-end space-x-4">
                <a href="{{ route('admin.verifications.show', $contractor->id) }}" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Cancel
                </a>
                <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Update Status
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 