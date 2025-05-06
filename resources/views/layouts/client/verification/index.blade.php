@extends('layouts.client.dashboard')

@section('content')
<div class="w-full p-6 max-w-6xl mx-auto">
    <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl">
        <!-- Header with gradient background -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white px-8 py-6">
            <h2 class="text-2xl font-bold tracking-tight">Contractor Verification</h2>
            <p class="text-blue-100 mt-1">Submit your credentials to unlock full platform access</p>
        </div>
        
        <div class="p-8">
            <!-- Status alerts with improved styling -->
            @if ($user->verification_status === 'under_review')
                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-5 rounded-lg mb-8 shadow-sm" role="alert">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-yellow-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-lg font-medium text-yellow-800">Documents Under Review</p>
                            <p class="text-yellow-700 mt-1">We're currently reviewing your submitted documents. You'll receive an email notification once the verification process is complete.</p>
                            @if ($user->admin_feedback)
                                <div class="mt-4 bg-white p-4 rounded-md border border-yellow-200">
                                    <p class="font-medium text-gray-700">Feedback from Administrator:</p>
                                    <p class="italic text-gray-600 mt-1">{{ $user->admin_feedback }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @elseif ($user->verification_status === 'rejected')
                <div class="bg-red-50 border-l-4 border-red-400 p-5 rounded-lg mb-8 shadow-sm" role="alert">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-red-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-lg font-medium text-red-800">Verification Rejected</p>
                            <p class="text-red-700 mt-1">Unfortunately, your verification was not approved. Please review the feedback below and resubmit your documents.</p>
                            @if ($user->admin_feedback)
                                <div class="mt-4 bg-white p-4 rounded-md border border-red-200">
                                    <p class="font-medium text-gray-700">Feedback from Administrator:</p>
                                    <p class="italic text-gray-600 mt-1">{{ $user->admin_feedback }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-blue-50 border-l-4 border-blue-400 p-5 rounded-lg mb-8 shadow-sm" role="alert">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-lg font-medium text-blue-800">Verification Required</p>
                            <p class="text-blue-700 mt-1">To gain full access to the system, we need to verify your contractor credentials. Please submit the required documents below.</p>
                        </div>
                    </div>
                </div>
            @endif

            <form action="{{ route('verification.submit') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                
                <!-- Business Information Section -->
                <div class="bg-gray-50 rounded-xl p-6 border border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        Business Information
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="transition-all duration-200 focus-within:ring-2 focus-within:ring-blue-300 focus-within:ring-offset-2 rounded-lg">
                            <label for="license_number" class="block text-sm font-medium text-gray-700 mb-1">Contractor License Number <span class="text-red-500">*</span></label>
                            <input type="text" name="license_number" id="license_number" value="{{ old('license_number', $user->license_number) }}" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full px-4 py-3 text-gray-900 border border-gray-300 rounded-lg @error('license_number') border-red-500 @enderror" placeholder="Enter your license number" required>
                            @error('license_number')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="transition-all duration-200 focus-within:ring-2 focus-within:ring-blue-300 focus-within:ring-offset-2 rounded-lg">
                            <label for="company_name" class="block text-sm font-medium text-gray-700 mb-1">Company Name <span class="text-red-500">*</span></label>
                            <input type="text" name="company_name" id="company_name" value="{{ old('company_name', $user->company_name) }}" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full px-4 py-3 text-gray-900 border border-gray-300 rounded-lg @error('company_name') border-red-500 @enderror" placeholder="Enter your company name" required>
                            @error('company_name')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                        <div class="transition-all duration-200 focus-within:ring-2 focus-within:ring-blue-300 focus-within:ring-offset-2 rounded-lg">
                            <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Business Address <span class="text-red-500">*</span></label>
                            <input type="text" name="address" id="address" value="{{ old('address', $user->address) }}" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full px-4 py-3 text-gray-900 border border-gray-300 rounded-lg @error('address') border-red-500 @enderror" placeholder="Enter your business address" required>
                            @error('address')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="transition-all duration-200 focus-within:ring-2 focus-within:ring-blue-300 focus-within:ring-offset-2 rounded-lg">
                            <label for="phone_number" class="block text-sm font-medium text-gray-700 mb-1">Phone Number <span class="text-red-500">*</span></label>
                            <input type="tel" name="phone_number" id="phone_number" value="{{ old('phone_number', $user->phone_number) }}" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full px-4 py-3 text-gray-900 border border-gray-300 rounded-lg @error('phone_number') border-red-500 @enderror" placeholder="Enter your phone number" required>
                            @error('phone_number')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Required Documents Section -->
                <div class="bg-gray-50 rounded-xl p-6 border border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Required Documents
                    </h3>
                    
                    <div class="space-y-6">
                        <div class="bg-white border border-gray-200 rounded-lg p-5 shadow-sm transition-all duration-300 hover:shadow-md">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 pt-1">
                                    <svg class="h-6 w-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                                    </svg>
                                </div>
                                <div class="ml-4 flex-1">
                                    <label for="contractor_license" class="block text-sm font-medium text-gray-700 mb-1">Contractor License <span class="text-red-500">*</span></label>
                                    <p class="text-sm text-gray-500 mb-3">Upload a copy of your contractor license (PDF, JPG, PNG files, max 10MB)</p>
                                    <div class="relative">
                                        <input type="file" name="contractor_license" id="contractor_license" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer @error('contractor_license') border-red-500 @enderror" accept=".pdf,.jpg,.jpeg,.png">
                                    </div>
                                    @error('contractor_license')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                    @if ($user->contractor_license_file)
                                        <div class="mt-2 text-sm text-green-600 flex items-center">
                                            <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            File previously uploaded. Submit a new file to replace it.
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="bg-white border border-gray-200 rounded-lg p-5 shadow-sm transition-all duration-300 hover:shadow-md">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 pt-1">
                                    <svg class="h-6 w-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                                    </svg>
                                </div>
                                <div class="ml-4 flex-1">
                                    <label for="drivers_license" class="block text-sm font-medium text-gray-700 mb-1">Driver's License <span class="text-red-500">*</span></label>
                                    <p class="text-sm text-gray-500 mb-3">Upload a copy of your driver's license (PDF, JPG, PNG files, max 10MB)</p>
                                    <div class="relative">
                                        <input type="file" name="drivers_license" id="drivers_license" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer @error('drivers_license') border-red-500 @enderror" accept=".pdf,.jpg,.jpeg,.png">
                                    </div>
                                    @error('drivers_license')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                    @if ($user->drivers_license_file)
                                        <div class="mt-2 text-sm text-green-600 flex items-center">
                                            <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            File previously uploaded. Submit a new file to replace it.
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="bg-white border border-gray-200 rounded-lg p-5 shadow-sm transition-all duration-300 hover:shadow-md">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 pt-1">
                                    <svg class="h-6 w-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                                    </svg>
                                </div>
                                <div class="ml-4 flex-1">
                                    <label for="insurance_certificate" class="block text-sm font-medium text-gray-700 mb-1">Insurance Certificate <span class="text-red-500">*</span></label>
                                    <p class="text-sm text-gray-500 mb-3">Upload a copy of your insurance certificate (PDF, JPG, PNG files, max 10MB)</p>
                                    <div class="relative">
                                        <input type="file" name="insurance_certificate" id="insurance_certificate" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer @error('insurance_certificate') border-red-500 @enderror" accept=".pdf,.jpg,.jpeg,.png">
                                    </div>
                                    @error('insurance_certificate')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                    @if ($user->insurance_certificate_file)
                                        <div class="mt-2 text-sm text-green-600 flex items-center">
                                            <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            File previously uploaded. Submit a new file to replace it.
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-center pt-4">
                    <button type="submit" class="inline-flex items-center justify-center py-3 px-8 border border-transparent shadow-md text-base font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 transform hover:-translate-y-1">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Submit Documents for Verification
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 