@extends('layouts.admin.dashboard')

@section('content')
<div class="animate-fadeIn">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl md:text-2xl font-bold">Create New Contractor</h2>
        <a href="{{ route('admin.contractors.index') }}" class="text-blue-500 hover:underline flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Back to Contractors
        </a>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('admin.contractors.store') }}" method="POST">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Basic Information -->
                <div class="bg-gray-50 p-6 rounded-lg">
                    <h3 class="text-lg font-semibold mb-4 border-b pb-2">Basic Information</h3>
                    
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Full Name <span class="text-red-500">*</span></label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('name') border-red-500 @enderror" required>
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email Address <span class="text-red-500">*</span></label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('email') border-red-500 @enderror" required>
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700">Password <span class="text-red-500">*</span></label>
                        <input type="password" name="password" id="password" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('password') border-red-500 @enderror" required>
                        @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password <span class="text-red-500">*</span></label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                    </div>
                    
                    <div class="mb-4">
                        <label for="phone_number" class="block text-sm font-medium text-gray-700">Phone Number</label>
                        <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number') }}" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('phone_number') border-red-500 @enderror">
                        @error('phone_number')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <!-- Company Information -->
                <div class="bg-gray-50 p-6 rounded-lg">
                    <h3 class="text-lg font-semibold mb-4 border-b pb-2">Company Information</h3>
                    
                    <div class="mb-4">
                        <label for="company_name" class="block text-sm font-medium text-gray-700">Company Name</label>
                        <input type="text" name="company_name" id="company_name" value="{{ old('company_name') }}" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('company_name') border-red-500 @enderror">
                        @error('company_name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="company_type" class="block text-sm font-medium text-gray-700">Company Type</label>
                        <select name="company_type" id="company_type" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            <option value="">Select Type</option>
                            <option value="general_contractor" {{ old('company_type') == 'general_contractor' ? 'selected' : '' }}>General Contractor</option>
                            <option value="subcontractor" {{ old('company_type') == 'subcontractor' ? 'selected' : '' }}>Subcontractor</option>
                            <option value="home_builder" {{ old('company_type') == 'home_builder' ? 'selected' : '' }}>Home Builder</option>
                            <option value="developer" {{ old('company_type') == 'developer' ? 'selected' : '' }}>Developer</option>
                            <option value="architect" {{ old('company_type') == 'architect' ? 'selected' : '' }}>Architect</option>
                            <option value="other" {{ old('company_type') == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>
                    
                    <div class="mb-4">
                        <label for="company_size" class="block text-sm font-medium text-gray-700">Company Size</label>
                        <select name="company_size" id="company_size" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            <option value="">Select Size</option>
                            <option value="1-10" {{ old('company_size') == '1-10' ? 'selected' : '' }}>1-10 employees</option>
                            <option value="11-50" {{ old('company_size') == '11-50' ? 'selected' : '' }}>11-50 employees</option>
                            <option value="51-100" {{ old('company_size') == '51-100' ? 'selected' : '' }}>51-100 employees</option>
                            <option value="100+" {{ old('company_size') == '100+' ? 'selected' : '' }}>100+ employees</option>
                        </select>
                    </div>
                    
                    <div class="mb-4">
                        <label for="license_number" class="block text-sm font-medium text-gray-700">Contractor License Number</label>
                        <input type="text" name="license_number" id="license_number" value="{{ old('license_number') }}" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('license_number') border-red-500 @enderror">
                        @error('license_number')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            
            <!-- Address Information -->
            <div class="mt-6 bg-gray-50 p-6 rounded-lg">
                <h3 class="text-lg font-semibold mb-4 border-b pb-2">Address Information</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="mb-4">
                        <label for="address" class="block text-sm font-medium text-gray-700">Street Address</label>
                        <input type="text" name="address" id="address" value="{{ old('address') }}" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('address') border-red-500 @enderror">
                        @error('address')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                        <input type="text" name="city" id="city" value="{{ old('city') }}" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('city') border-red-500 @enderror">
                        @error('city')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="state" class="block text-sm font-medium text-gray-700">State/Province</label>
                        <input type="text" name="state" id="state" value="{{ old('state') }}" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('state') border-red-500 @enderror">
                        @error('state')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="zip" class="block text-sm font-medium text-gray-700">ZIP/Postal Code</label>
                        <input type="text" name="zip" id="zip" value="{{ old('zip') }}" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('zip') border-red-500 @enderror">
                        @error('zip')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            
            <!-- Preferences -->
            <div class="mt-6 bg-gray-50 p-6 rounded-lg">
                <h3 class="text-lg font-semibold mb-4 border-b pb-2">Preferences & Verification</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Project Types</label>
                        <div class="space-y-2">
                            <div class="flex items-center">
                                <input id="project_type_residential" name="project_types[]" type="checkbox" value="residential" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" {{ is_array(old('project_types')) && in_array('residential', old('project_types')) ? 'checked' : '' }}>
                                <label for="project_type_residential" class="ml-2 block text-sm text-gray-700">Residential</label>
                            </div>
                            <div class="flex items-center">
                                <input id="project_type_commercial" name="project_types[]" type="checkbox" value="commercial" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" {{ is_array(old('project_types')) && in_array('commercial', old('project_types')) ? 'checked' : '' }}>
                                <label for="project_type_commercial" class="ml-2 block text-sm text-gray-700">Commercial</label>
                            </div>
                            <div class="flex items-center">
                                <input id="project_type_industrial" name="project_types[]" type="checkbox" value="industrial" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" {{ is_array(old('project_types')) && in_array('industrial', old('project_types')) ? 'checked' : '' }}>
                                <label for="project_type_industrial" class="ml-2 block text-sm text-gray-700">Industrial</label>
                            </div>
                            <div class="flex items-center">
                                <input id="project_type_institutional" name="project_types[]" type="checkbox" value="institutional" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" {{ is_array(old('project_types')) && in_array('institutional', old('project_types')) ? 'checked' : '' }}>
                                <label for="project_type_institutional" class="ml-2 block text-sm text-gray-700">Institutional</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Services Interested In</label>
                        <div class="space-y-2">
                            <div class="flex items-center">
                                <input id="service_permit" name="services[]" type="checkbox" value="permit-management" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" {{ is_array(old('services')) && in_array('permit-management', old('services')) ? 'checked' : '' }}>
                                <label for="service_permit" class="ml-2 block text-sm text-gray-700">Permit Management</label>
                            </div>
                            <div class="flex items-center">
                                <input id="service_document" name="services[]" type="checkbox" value="document-management" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" {{ is_array(old('services')) && in_array('document-management', old('services')) ? 'checked' : '' }}>
                                <label for="service_document" class="ml-2 block text-sm text-gray-700">Document Management</label>
                            </div>
                            <div class="flex items-center">
                                <input id="service_project" name="services[]" type="checkbox" value="project-management" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" {{ is_array(old('services')) && in_array('project-management', old('services')) ? 'checked' : '' }}>
                                <label for="service_project" class="ml-2 block text-sm text-gray-700">Project Management</label>
                            </div>
                            <div class="flex items-center">
                                <input id="service_communication" name="services[]" type="checkbox" value="client-communication" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" {{ is_array(old('services')) && in_array('client-communication', old('services')) ? 'checked' : '' }}>
                                <label for="service_communication" class="ml-2 block text-sm text-gray-700">Client Communication</label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-4">
                    <label for="project_volume" class="block text-sm font-medium text-gray-700">Project Volume (Per Year)</label>
                    <select name="project_volume" id="project_volume" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        <option value="">Select Volume</option>
                        <option value="1-5" {{ old('project_volume') == '1-5' ? 'selected' : '' }}>1-5 projects</option>
                        <option value="6-10" {{ old('project_volume') == '6-10' ? 'selected' : '' }}>6-10 projects</option>
                        <option value="11-20" {{ old('project_volume') == '11-20' ? 'selected' : '' }}>11-20 projects</option>
                        <option value="21-50" {{ old('project_volume') == '21-50' ? 'selected' : '' }}>21-50 projects</option>
                        <option value="50+" {{ old('project_volume') == '50+' ? 'selected' : '' }}>50+ projects</option>
                    </select>
                </div>
                
                <div class="mt-4">
                    <label for="verification_status" class="block text-sm font-medium text-gray-700">Verification Status</label>
                    <select name="verification_status" id="verification_status" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        <option value="pending" {{ old('verification_status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="under_review" {{ old('verification_status') == 'under_review' ? 'selected' : '' }}>Under Review</option>
                        <option value="approved" {{ old('verification_status') == 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="rejected" {{ old('verification_status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                    <p class="text-sm text-gray-500 mt-1">Setting to 'Approved' will automatically verify the contractor and grant them full access.</p>
                </div>
            </div>
            
            <div class="mt-6 flex justify-end space-x-3">
                <a href="{{ route('admin.contractors.index') }}" class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Cancel
                </a>
                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Create Contractor
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 