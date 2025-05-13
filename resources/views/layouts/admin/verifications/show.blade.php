@extends('layouts.admin.dashboard')

@section('content')
<div class="animate-fadeIn">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl md:text-2xl font-bold">Verification Review</h2>
        <a href="{{ route('admin.verifications.index') }}" class="text-blue-500 hover:underline flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Back to Verifications
        </a>
    </div>
    
    <!-- Status and Actions -->
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
            <div>
                <h3 class="font-bold text-lg">{{ $contractor->name }}</h3>
                <p class="text-gray-600">{{ $contractor->company_name ?? 'No Company Name' }}</p>
                
                <div class="mt-2">
                    @if($contractor->verification_status == 'approved')
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                            <svg class="-ml-1 mr-1.5 h-4 w-4 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            Verified
                        </span>
                    @elseif($contractor->verification_status == 'rejected')
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                            <svg class="-ml-1 mr-1.5 h-4 w-4 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                            Rejected
                        </span>
                    @else
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                            <svg class="-ml-1 mr-1.5 h-4 w-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            Pending Review
                        </span>
                    @endif
                </div>
            </div>
            
            <div class="mt-4 md:mt-0 space-x-2">
                <a href="{{ route('admin.verifications.edit', $contractor->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded font-medium">
                    <i class="fas fa-edit mr-1"></i> Update Status
                </a>
                <a href="{{ route('admin.contractors.show', $contractor->id) }}" class="bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded font-medium">
                    <i class="fas fa-user mr-1"></i> View Profile
                </a>
            </div>
        </div>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Contractor Information -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold border-b pb-2 mb-4">Contractor Information</h3>
            
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Name</label>
                    <div class="mt-1 text-gray-900">{{ $contractor->name }}</div>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <div class="mt-1 text-gray-900">{{ $contractor->email }}</div>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Phone Number</label>
                    <div class="mt-1 text-gray-900">{{ $contractor->phone_number ?? 'Not provided' }}</div>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">License Number</label>
                    <div class="mt-1 text-gray-900">{{ $contractor->license_number ?? 'Not provided' }}</div>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Company Name</label>
                    <div class="mt-1 text-gray-900">{{ $contractor->company_name ?? 'Not provided' }}</div>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Address</label>
                    <div class="mt-1 text-gray-900">
                        @if($contractor->address)
                            {{ $contractor->address }}<br>
                            {{ $contractor->city }}, {{ $contractor->state }} {{ $contractor->zip }}
                        @else
                            Not provided
                        @endif
                    </div>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Verification Status</label>
                    <div class="mt-1">
                        @if($contractor->verification_status == 'approved')
                            <span class="text-green-600 font-medium">Verified</span>
                        @elseif($contractor->verification_status == 'rejected')
                            <span class="text-red-600 font-medium">Rejected</span>
                        @else
                            <span class="text-yellow-600 font-medium">Pending Review</span>
                        @endif
                    </div>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Documents Submitted</label>
                    <div class="mt-1 text-gray-900">{{ $contractor->documents_submitted_at ? $contractor->documents_submitted_at->format('F d, Y') : 'Not submitted' }}</div>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Verified On</label>
                    <div class="mt-1 text-gray-900">{{ $contractor->verified_at ? $contractor->verified_at->format('F d, Y') : 'Not verified' }}</div>
                </div>
            </div>
        </div>
        
        <!-- Documents Review -->
        <div class="md:col-span-2 bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold border-b pb-2 mb-4">Document Review</h3>
            
            <div class="space-y-6">
                <!-- Contractor License -->
                <div class="p-4 border rounded-lg">
                    <div class="flex justify-between items-start">
                        <div>
                            <h4 class="font-medium text-gray-900">Contractor License</h4>
                            <p class="text-sm text-gray-500">Required document for verification</p>
                        </div>
                        
                        @if($contractor->contractor_license_file)
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.verifications.documents.download', ['contractor' => $contractor->id, 'documentType' => 'license']) }}" class="text-blue-600 hover:text-blue-800">
                                    <i class="fas fa-download"></i>
                                </a>
                                <a href="{{ route('admin.verifications.documents.preview', ['contractor' => $contractor->id, 'documentType' => 'license']) }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                        @endif
                    </div>
                    
                    <div class="mt-4">
                        @if($contractor->contractor_license_file)
                            <div class="bg-gray-100 rounded-lg p-3 text-sm">
                                <div class="flex items-center">
                                    <i class="fas fa-file-pdf text-red-500 mr-2"></i>
                                    <span class="text-gray-700">Contractor License Document</span>
                                </div>
                                <div class="mt-2 text-xs text-gray-500">
                                    Uploaded: {{ $contractor->documents_submitted_at ? $contractor->documents_submitted_at->format('F d, Y') : 'Unknown date' }}
                                </div>
                            </div>
                        @else
                            <div class="bg-yellow-50 rounded-lg p-3 text-sm">
                                <div class="flex items-center text-yellow-700">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    <span>No contractor license document uploaded</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                
                <!-- Driver's License -->
                <div class="p-4 border rounded-lg">
                    <div class="flex justify-between items-start">
                        <div>
                            <h4 class="font-medium text-gray-900">Driver's License</h4>
                            <p class="text-sm text-gray-500">Required document for verification</p>
                        </div>
                        
                        @if($contractor->drivers_license_file)
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.verifications.documents.download', ['contractor' => $contractor->id, 'documentType' => 'drivers']) }}" class="text-blue-600 hover:text-blue-800">
                                    <i class="fas fa-download"></i>
                                </a>
                                <a href="{{ route('admin.verifications.documents.preview', ['contractor' => $contractor->id, 'documentType' => 'drivers']) }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                        @endif
                    </div>
                    
                    <div class="mt-4">
                        @if($contractor->drivers_license_file)
                            <div class="bg-gray-100 rounded-lg p-3 text-sm">
                                <div class="flex items-center">
                                    <i class="fas fa-file-pdf text-red-500 mr-2"></i>
                                    <span class="text-gray-700">Driver's License Document</span>
                                </div>
                                <div class="mt-2 text-xs text-gray-500">
                                    Uploaded: {{ $contractor->documents_submitted_at ? $contractor->documents_submitted_at->format('F d, Y') : 'Unknown date' }}
                                </div>
                            </div>
                        @else
                            <div class="bg-yellow-50 rounded-lg p-3 text-sm">
                                <div class="flex items-center text-yellow-700">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    <span>No driver's license document uploaded</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                
                <!-- Insurance Certificate -->
                <div class="p-4 border rounded-lg">
                    <div class="flex justify-between items-start">
                        <div>
                            <h4 class="font-medium text-gray-900">Insurance Certificate</h4>
                            <p class="text-sm text-gray-500">Required document for verification</p>
                        </div>
                        
                        @if($contractor->insurance_certificate_file)
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.verifications.documents.download', ['contractor' => $contractor->id, 'documentType' => 'insurance']) }}" class="text-blue-600 hover:text-blue-800">
                                    <i class="fas fa-download"></i>
                                </a>
                                <a href="{{ route('admin.verifications.documents.preview', ['contractor' => $contractor->id, 'documentType' => 'insurance']) }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                        @endif
                    </div>
                    
                    <div class="mt-4">
                        @if($contractor->insurance_certificate_file)
                            <div class="bg-gray-100 rounded-lg p-3 text-sm">
                                <div class="flex items-center">
                                    <i class="fas fa-file-pdf text-red-500 mr-2"></i>
                                    <span class="text-gray-700">Insurance Certificate Document</span>
                                </div>
                                <div class="mt-2 text-xs text-gray-500">
                                    Uploaded: {{ $contractor->documents_submitted_at ? $contractor->documents_submitted_at->format('F d, Y') : 'Unknown date' }}
                                </div>
                            </div>
                        @else
                            <div class="bg-yellow-50 rounded-lg p-3 text-sm">
                                <div class="flex items-center text-yellow-700">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    <span>No insurance certificate document uploaded</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                
                <!-- Admin Feedback -->
                <div class="p-4 border rounded-lg">
                    <h4 class="font-medium text-gray-900">Admin Feedback</h4>
                    <div class="mt-2">
                        @if($contractor->admin_feedback)
                            <p class="text-gray-700 italic">{{ $contractor->admin_feedback }}</p>
                        @else
                            <p class="text-gray-500 italic">No feedback provided</p>
                        @endif
                    </div>
                </div>
                
                <!-- Action Buttons -->
                <div class="flex justify-end space-x-4 mt-6">
                    <a href="{{ route('admin.verifications.edit', $contractor->id) }}" class="px-6 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-md font-medium">
                        Update Verification Status
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 