@extends('layouts.admin.dashboard')

@section('content')
<div class="container py-4">
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <h1>Verification Details</h1>
        <a href="{{ route('admin.verifications.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Back to All Verifications
        </a>
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
        <div class="col-md-5">
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
                        <h5 class="text-muted">Phone</h5>
                        <p class="fs-5">{{ $contractor->phone ?? 'Not provided' }}</p>
                    </div>
                    <div class="mb-3">
                        <h5 class="text-muted">License Number</h5>
                        <p class="fs-5">{{ $contractor->license_number ?? 'Not provided' }}</p>
                    </div>
                    <div class="mb-3">
                        <h5 class="text-muted">Company Name</h5>
                        <p class="fs-5">{{ $contractor->company_name ?? 'Not provided' }}</p>
                    </div>
                    <div class="mb-3">
                        <h5 class="text-muted">Joined On</h5>
                        <p class="fs-5">{{ $contractor->created_at->format('M d, Y') }}</p>
                    </div>
                    <div class="mb-3">
                        <h5 class="text-muted">Verification Status</h5>
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
        </div>

        <div class="col-md-7">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h4 class="card-title mb-0">Verification Documents</h4>
                </div>
                <div class="card-body">
                    @if($contractor->documents_submitted_at)
                        <div class="row">
                            @if($contractor->license_document)
                                <div class="col-md-6 mb-4">
                                    <div class="card">
                                        <div class="card-header">License Document</div>
                                        <div class="card-body">
                                            <img src="{{ asset('storage/' . $contractor->license_document) }}" class="img-fluid mb-2" alt="License Document">
                                            <a href="{{ asset('storage/' . $contractor->license_document) }}" class="btn btn-sm btn-outline-primary w-100" target="_blank">
                                                View Full Size
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if($contractor->insurance_document)
                                <div class="col-md-6 mb-4">
                                    <div class="card">
                                        <div class="card-header">Insurance Document</div>
                                        <div class="card-body">
                                            <img src="{{ asset('storage/' . $contractor->insurance_document) }}" class="img-fluid mb-2" alt="Insurance Document">
                                            <a href="{{ asset('storage/' . $contractor->insurance_document) }}" class="btn btn-sm btn-outline-primary w-100" target="_blank">
                                                View Full Size
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if($contractor->additional_document)
                                <div class="col-md-6 mb-4">
                                    <div class="card">
                                        <div class="card-header">Additional Document</div>
                                        <div class="card-body">
                                            <img src="{{ asset('storage/' . $contractor->additional_document) }}" class="img-fluid mb-2" alt="Additional Document">
                                            <a href="{{ asset('storage/' . $contractor->additional_document) }}" class="btn btn-sm btn-outline-primary w-100" target="_blank">
                                                View Full Size
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="mt-4">
                            <h5>Update Verification Status</h5>
                            <form action="{{ route('admin.verifications.update', $contractor) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="verification_status" class="form-label">Status</label>
                                    <select name="verification_status" id="verification_status" class="form-select @error('verification_status') is-invalid @enderror" required>
                                        <option value="">Select Status</option>
                                        <option value="verified" {{ $contractor->is_verified ? 'selected' : '' }}>Approve Verification</option>
                                        <option value="rejected" {{ $contractor->verification_rejected_at ? 'selected' : '' }}>Reject Verification</option>
                                    </select>
                                    @error('verification_status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3" id="feedback_container" style="display: none;">
                                    <label for="feedback" class="form-label">Feedback</label>
                                    <textarea name="feedback" id="feedback" rows="3" class="form-control @error('feedback') is-invalid @enderror" placeholder="Provide feedback for the contractor">{{ old('feedback', $contractor->verification_feedback) }}</textarea>
                                    <div class="form-text">Required when rejecting verification. Recommended for approvals.</div>
                                    @error('feedback')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="notify_contractor" name="notify_contractor" value="1" checked>
                                        <label class="form-check-label" for="notify_contractor">
                                            Notify contractor via email
                                        </label>
                                        <div class="form-text">Send an email notification to the contractor about this status change.</div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Update Status</button>
                            </form>
                        </div>
                    @else
                        <div class="alert alert-info">
                            This contractor has not submitted verification documents yet.
                        </div>
                    @endif
                </div>
            </div>

            @if($contractor->verification_feedback)
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <h4 class="card-title mb-0">Verification Feedback</h4>
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
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const statusSelect = document.getElementById('verification_status');
        const feedbackContainer = document.getElementById('feedback_container');
        
        function toggleFeedback() {
            if (statusSelect.value === 'rejected') {
                feedbackContainer.style.display = 'block';
                document.getElementById('feedback').setAttribute('required', 'required');
            } else if (statusSelect.value === 'verified') {
                feedbackContainer.style.display = 'block';
                document.getElementById('feedback').removeAttribute('required');
            } else {
                feedbackContainer.style.display = 'none';
                document.getElementById('feedback').removeAttribute('required');
            }
        }
        
        statusSelect.addEventListener('change', toggleFeedback);
        toggleFeedback();
    });
</script>
@endpush
@endsection 