@extends('layouts.admin.dashboard')

@section('content')
<div class="animate-fadeIn">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl md:text-2xl font-bold">Contractor Details</h2>
        <a href="{{ route('admin.contractors.index') }}" class="text-blue-500 hover:underline flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Back to Contractors
        </a>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Company Information -->
            <div>
                <h3 class="text-lg font-semibold text-navy border-b pb-2 mb-4">Company Information</h3>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-gray-500 text-sm">Company Name</label>
                        <div class="font-medium">{{ $contractor->company_name ?? 'N/A' }}</div>
                    </div>
                    
                    <div>
                        <label class="block text-gray-500 text-sm">Company Type</label>
                        <div class="font-medium">{{ $contractor->company_type ?? 'N/A' }}</div>
                    </div>
                    
                    <div>
                        <label class="block text-gray-500 text-sm">Company Size</label>
                        <div class="font-medium">{{ $contractor->company_size ?? 'N/A' }}</div>
                    </div>
                    
                    <div>
                        <label class="block text-gray-500 text-sm">Address</label>
                        <div class="font-medium">
                            @if($contractor->address)
                                {{ $contractor->address }}<br>
                                {{ $contractor->city }}, {{ $contractor->state }} {{ $contractor->zip }}
                            @else
                                N/A
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Contact Information -->
            <div>
                <h3 class="text-lg font-semibold text-navy border-b pb-2 mb-4">Contact Information</h3>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-gray-500 text-sm">Primary Contact</label>
                        <div class="font-medium">{{ $contractor->name }}</div>
                    </div>
                    
                    <div>
                        <label class="block text-gray-500 text-sm">Email</label>
                        <div class="font-medium">{{ $contractor->email }}</div>
                    </div>
                    
                    <div>
                        <label class="block text-gray-500 text-sm">Phone</label>
                        <div class="font-medium">{{ $contractor->phone_number ?? 'N/A' }}</div>
                    </div>
                    
                    <div>
                        <label class="block text-gray-500 text-sm">Registered On</label>
                        <div class="font-medium">{{ $contractor->created_at->format('F d, Y') }}</div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Preferences -->
        <div class="mt-8">
            <h3 class="text-lg font-semibold text-navy border-b pb-2 mb-4">Preferences</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <label class="block text-gray-500 text-sm mb-2">Project Types</label>
                    @if(!empty($contractor->project_types))
                        <ul class="list-disc list-inside space-y-1">
                            @foreach($contractor->project_types as $type)
                                <li>{{ ucfirst(str_replace('-', ' ', $type)) }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p>No project types specified</p>
                    @endif
                </div>
                
                <div>
                    <label class="block text-gray-500 text-sm mb-2">Services Interested In</label>
                    @if(!empty($contractor->services))
                        <ul class="list-disc list-inside space-y-1">
                            @foreach($contractor->services as $service)
                                <li>{{ ucfirst(str_replace('-', ' ', $service)) }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p>No services specified</p>
                    @endif
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-4">
                <div>
                    <label class="block text-gray-500 text-sm">Project Volume (Per Year)</label>
                    <div class="font-medium">{{ $contractor->project_volume ?? 'Not specified' }}</div>
                </div>
                
                <div>
                    <label class="block text-gray-500 text-sm">How They Heard About Us</label>
                    <div class="font-medium">{{ $contractor->hear_about ? ucfirst($contractor->hear_about) : 'Not specified' }}</div>
                </div>
            </div>
        </div>
        
        <!-- Action Buttons -->
        <div class="mt-8 flex gap-4">
            <button class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                <i class="fas fa-envelope mr-2"></i> Send Email
            </button>
            <button class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded">
                <i class="fas fa-edit mr-2"></i> Edit Profile
            </button>
            <form action="{{ route('admin.contractors.destroy', $contractor->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this contractor? This will delete all related data including projects, permits, documents, and invoices.');">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                    <i class="fas fa-trash mr-2"></i> Delete Contractor
                </button>
            </form>
        </div>
    </div>
</div>
@endsection 