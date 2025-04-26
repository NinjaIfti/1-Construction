@extends('layouts.client.dashboard')

@section('content')
<div class="w-full p-6">
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="bg-blue-600 text-white px-6 py-4">
            <h2 class="text-2xl font-bold">Verification Required</h2>
        </div>
        <div class="p-6">
            @if ($user->verification_status === 'under_review')
                <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-6" role="alert">
                    <p class="font-bold">Documents Under Review</p>
                    <p>We're currently reviewing your submitted documents. You'll receive an email notification once the verification process is complete.</p>
                    @if ($user->admin_feedback)
                        <div class="mt-4">
                            <p class="font-bold">Feedback from Administrator:</p>
                            <p class="italic">{{ $user->admin_feedback }}</p>
                        </div>
                    @endif
                </div>
            @elseif ($user->verification_status === 'rejected')
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                    <p class="font-bold">Verification Rejected</p>
                    <p>Unfortunately, your verification was not approved. Please review the feedback below and resubmit your documents.</p>
                    @if ($user->admin_feedback)
                        <div class="mt-4">
                            <p class="font-bold">Feedback from Administrator:</p>
                            <p class="italic">{{ $user->admin_feedback }}</p>
                        </div>
                    @endif
                </div>
            @else
                <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 mb-6" role="alert">
                    <p class="font-bold">Verification Required</p>
                    <p>To gain full access to the system, we need to verify your contractor credentials. Please submit the required documents below.</p>
                </div>
            @endif

            <form action="{{ route('verification.submit') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="license_number" class="block text-sm font-medium text-gray-700 mb-1">Contractor License Number <span class="text-red-500">*</span></label>
                        <input type="text" name="license_number" id="license_number" value="{{ old('license_number', $user->license_number) }}" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md @error('license_number') border-red-500 @enderror" placeholder="Enter your license number" required>
                        @error('license_number')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="company_name" class="block text-sm font-medium text-gray-700 mb-1">Company Name <span class="text-red-500">*</span></label>
                        <input type="text" name="company_name" id="company_name" value="{{ old('company_name', $user->company_name) }}" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md @error('company_name') border-red-500 @enderror" placeholder="Enter your company name" required>
                        @error('company_name')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Business Address <span class="text-red-500">*</span></label>
                        <input type="text" name="address" id="address" value="{{ old('address', $user->address) }}" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md @error('address') border-red-500 @enderror" placeholder="Enter your business address" required>
                        @error('address')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="phone_number" class="block text-sm font-medium text-gray-700 mb-1">Phone Number <span class="text-red-500">*</span></label>
                        <input type="tel" name="phone_number" id="phone_number" value="{{ old('phone_number', $user->phone_number) }}" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md @error('phone_number') border-red-500 @enderror" placeholder="Enter your phone number" required>
                        @error('phone_number')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Required Documents</h3>
                    <div class="space-y-6">
                        <div class="border border-gray-200 rounded-lg p-4">
                            <label for="contractor_license" class="block text-sm font-medium text-gray-700 mb-2">Contractor License <span class="text-red-500">*</span></label>
                            <p class="text-sm text-gray-500 mb-3">Upload a copy of your contractor license (PDF, JPG, PNG files, max 10MB)</p>
                            <input type="file" name="contractor_license" id="contractor_license" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none @error('contractor_license') border-red-500 @enderror" accept=".pdf,.jpg,.jpeg,.png">
                            @error('contractor_license')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                            @if ($user->contractor_license_file)
                                <div class="mt-2 text-sm text-gray-600">
                                    File previously uploaded. Submit a new file to replace it.
                                </div>
                            @endif
                        </div>

                        <div class="border border-gray-200 rounded-lg p-4">
                            <label for="drivers_license" class="block text-sm font-medium text-gray-700 mb-2">Driver's License <span class="text-red-500">*</span></label>
                            <p class="text-sm text-gray-500 mb-3">Upload a copy of your driver's license (PDF, JPG, PNG files, max 10MB)</p>
                            <input type="file" name="drivers_license" id="drivers_license" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none @error('drivers_license') border-red-500 @enderror" accept=".pdf,.jpg,.jpeg,.png">
                            @error('drivers_license')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                            @if ($user->drivers_license_file)
                                <div class="mt-2 text-sm text-gray-600">
                                    File previously uploaded. Submit a new file to replace it.
                                </div>
                            @endif
                        </div>

                        <div class="border border-gray-200 rounded-lg p-4">
                            <label for="insurance_certificate" class="block text-sm font-medium text-gray-700 mb-2">Insurance Certificate <span class="text-red-500">*</span></label>
                            <p class="text-sm text-gray-500 mb-3">Upload a copy of your insurance certificate (PDF, JPG, PNG files, max 10MB)</p>
                            <input type="file" name="insurance_certificate" id="insurance_certificate" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none @error('insurance_certificate') border-red-500 @enderror" accept=".pdf,.jpg,.jpeg,.png">
                            @error('insurance_certificate')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                            @if ($user->insurance_certificate_file)
                                <div class="mt-2 text-sm text-gray-600">
                                    File previously uploaded. Submit a new file to replace it.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="text-center pt-4">
                    <button type="submit" class="inline-flex justify-center py-3 px-8 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        Submit Documents for Verification
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 