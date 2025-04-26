@extends('layouts.admin.dashboard')

@section('content')
<div class="container py-4">
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <h1>Edit Verification</h1>
        <div>
            <a href="{{ route('admin.verifications.show', $contractor) }}" class="btn btn-outline-secondary me-2">
                <i class="fas fa-eye"></i> View Details
            </a>
            <a href="{{ route('admin.verifications.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Back to All Verifications
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h4 class="card-title mb-0">Contractor Information</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <h5 class="text-muted">Name</h5>
                        <p class="fs-5">{{ $contractor->name }}</p>
                    </div>
                    <div class="mb-3">
                        <h5 class="text-muted">Email</h5>
                        <p class="fs-5">{{ $contractor->email }}</p>
                    </div>
                    <div class="mb-3">
                        <h5 class="text-muted">Current Status</h5>
                        @if($contractor->is_verified)
                            <span class="badge bg-success fs-6">Verified on {{ $contractor->verified_at->format('M d, Y') }}</span>
                        @elseif($contractor->verification_rejected_at)
                            <span class="badge bg-danger fs-6">Rejected on {{ $contractor->verification_rejected_at->format('M d, Y') }}</span>
                        @elseif($contractor->documents_submitted_at)
                            <span class="badge bg-warning fs-6">Pending Review</span>
                        @else
                            <span class="badge bg-secondary fs-6">Documents Not Submitted</span>
                        @endif
                    </div>
                </div>
            </div>

            @if($contractor->verification_feedback)
                <div class="card mb-4">
                    <div class="card-header bg-info text-white">
                        <h4 class="card-title mb-0">Previous Feedback</h4>
                    </div>
                    <div class="card-body">
                        <p class="mb-1"><strong>Last Updated:</strong> 
                            @if($contractor->verified_at && $contractor->verified_at > $contractor->verification_rejected_at)
                                {{ $contractor->verified_at->format('M d, Y h:i A') }}
                            @elseif($contractor->verification_rejected_at)
                                {{ $contractor->verification_rejected_at->format('M d, Y h:i A') }}
                            @else
                                N/A
                            @endif
                        </p>
                        <div class="p-3 bg-light rounded mt-2">
                            {{ $contractor->verification_feedback }}
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="card-title mb-0">Update Verification Status</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.verifications.update', $contractor) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label for="verification_status" class="form-label">Status</label>
                            <select name="verification_status" id="verification_status" class="form-select @error('verification_status') is-invalid @enderror" required>
                                <option value="">Select Status</option>
                                <option value="verified" {{ $contractor->is_verified ? 'selected' : '' }}>Approve Verification</option>
                                <option value="rejected" {{ $contractor->verification_rejected_at ? 'selected' : '' }}>Reject Verification</option>
                                <option value="pending" {{ (!$contractor->is_verified && !$contractor->verification_rejected_at && $contractor->documents_submitted_at) ? 'selected' : '' }}>Reset to Pending</option>
                            </select>
                            @error('verification_status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Change the verification status of this contractor.</div>
                        </div>

                        <div class="mb-4">
                            <label for="feedback" class="form-label">Feedback</label>
                            <textarea name="feedback" id="feedback" rows="5" class="form-control @error('feedback') is-invalid @enderror" placeholder="Provide feedback for the contractor">{{ old('feedback', $contractor->verification_feedback) }}</textarea>
                            <div class="form-text" id="feedback-help">Required when rejecting verification. Optional for approvals.</div>
                            @error('feedback')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4" id="notification_container">
                            <div class="form-check">
                                <input class="form-check-input @error('notify_contractor') is-invalid @enderror" type="checkbox" id="notify_contractor" name="notify_contractor" value="1" checked>
                                <label class="form-check-label" for="notify_contractor">
                                    Notify contractor via email
                                </label>
                                <div class="form-text">Send an email notification to the contractor about this status change.</div>
                                @error('notify_contractor')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('admin.verifications.show', $contractor) }}" class="btn btn-outline-secondary me-md-2">Cancel</a>
                            <button type="submit" class="btn btn-primary">Update Verification</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const statusSelect = document.getElementById('verification_status');
        const feedbackElement = document.getElementById('feedback');
        const feedbackHelp = document.getElementById('feedback-help');
        
        function updateFeedbackRequirement() {
            if (statusSelect.value === 'rejected') {
                feedbackElement.setAttribute('required', 'required');
                feedbackHelp.textContent = 'Required when rejecting verification. Please explain the reason for rejection.';
            } else {
                feedbackElement.removeAttribute('required');
                feedbackHelp.textContent = 'Optional for approvals or pending status.';
            }
        }
        
        statusSelect.addEventListener('change', updateFeedbackRequirement);
        updateFeedbackRequirement();
    });
</script>
@endpush
@endsection 