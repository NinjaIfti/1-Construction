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
                    @php
                        $projectTypes = $contractor->project_types;
                        if (is_string($projectTypes) && !empty($projectTypes)) {
                            try {
                                $projectTypes = json_decode($projectTypes, true);
                            } catch (\Exception $e) {
                                $projectTypes = null;
                            }
                        }
                    @endphp
                    
                    @if(!empty($projectTypes) && is_array($projectTypes))
                        <ul class="list-disc list-inside space-y-1">
                            @foreach($projectTypes as $type)
                                <li>{{ ucfirst(str_replace('-', ' ', $type)) }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p>No project types specified</p>
                    @endif
                </div>
                
                <div>
                    <label class="block text-gray-500 text-sm mb-2">Services Interested In</label>
                    @php
                        $services = $contractor->services;
                        if (is_string($services) && !empty($services)) {
                            try {
                                $services = json_decode($services, true);
                            } catch (\Exception $e) {
                                $services = null;
                            }
                        }
                    @endphp
                    
                    @if(!empty($services) && is_array($services))
                        <ul class="list-disc list-inside space-y-1">
                            @foreach($services as $service)
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
        
        <!-- Projects Summary -->
        <div class="mt-8">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-semibold text-navy border-b pb-2 mb-4">Projects</h3>
                <a href="{{ route('admin.projects.index', ['contractor_id' => $contractor->id]) }}" class="text-blue-500 hover:underline text-sm">
                    <i class="fas fa-external-link-alt mr-1"></i> View All Projects
                </a>
            </div>
            
            <div class="bg-white shadow overflow-hidden rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Start Date</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Budget</th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($contractor->projects ?? [] as $project)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $project->name }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        {{ $project->status === 'completed' ? 'bg-green-100 text-green-800' : 
                                           ($project->status === 'in_progress' ? 'bg-blue-100 text-blue-800' : 
                                            'bg-yellow-100 text-yellow-800') }}">
                                        {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $project->start_date ? $project->start_date->format('M d, Y') : 'N/A' }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    ${{ number_format($project->budget ?? 0, 2) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('admin.projects.show', $project) }}" class="text-blue-600 hover:text-blue-900">
                                        View
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 whitespace-nowrap text-center text-gray-500">
                                    No projects found for this contractor.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Permits Summary -->
        <div class="mt-8">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-semibold text-navy border-b pb-2 mb-4">Permits</h3>
                <a href="{{ route('admin.permits.contractor', $contractor) }}" class="text-blue-500 hover:underline text-sm">
                    <i class="fas fa-external-link-alt mr-1"></i> View All Permits
                </a>
            </div>
            
            <div class="bg-white shadow overflow-hidden rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Permit #</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Submission Date</th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @php
                            $permits = collect();
                            foreach(($contractor->projects ?? []) as $project) {
                                $permits = $permits->merge($project->permits ?? []);
                            }
                            $permits = $permits->sortByDesc('submission_date')->take(5);
                        @endphp
                        
                        @forelse($permits as $permit)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $permit->permit_number }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $permit->type }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                        {{ $permit->status == 'Approved' ? 'bg-green-100 text-green-800' : 
                                           ($permit->status == 'In Review' ? 'bg-blue-100 text-blue-800' : 
                                            ($permit->status == 'Rejected' ? 'bg-red-100 text-red-800' : 
                                             'bg-yellow-100 text-yellow-800')) }}">
                                        {{ $permit->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $permit->submission_date ? $permit->submission_date->format('M d, Y') : 'N/A' }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('admin.permits.show', $permit) }}" class="text-blue-600 hover:text-blue-900">
                                        View
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 whitespace-nowrap text-center text-gray-500">
                                    No permits found for this contractor.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Action Buttons -->
        <div class="mt-8 flex gap-4">
            <button class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                <i class="fas fa-envelope mr-2"></i> Send Email
            </button>
            <a href="{{ route('admin.contractors.edit', $contractor->id) }}" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded font-medium flex items-center">
                <i class="fas fa-edit mr-2"></i> Edit Profile
            </a>
            <form action="{{ route('admin.contractors.force-delete', $contractor->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this contractor? This will delete all related data including projects, permits, documents, and invoices.');">
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