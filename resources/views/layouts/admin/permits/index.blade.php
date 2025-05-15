@extends('layouts.admin.dashboard')

@section('content')
<div>
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">Permit Management</h2>
        <a href="{{ route('permits.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
            <i class="fas fa-plus mr-2"></i> Create Permit
        </a>
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
    
    <!-- Permit Status Overview -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-yellow-100 p-4 rounded-lg shadow-sm">
            <div class="flex justify-between items-center">
                <div>
                    <div class="text-xl font-bold">{{ $pendingCount }}</div>
                    <div class="text-sm text-gray-600">Pending</div>
                </div>
                <div class="rounded-full h-10 w-10 flex items-center justify-center bg-yellow-200">
                    <i class="fas fa-clock text-yellow-700"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-blue-100 p-4 rounded-lg shadow-sm">
            <div class="flex justify-between items-center">
                <div>
                    <div class="text-xl font-bold">{{ $inReviewCount }}</div>
                    <div class="text-sm text-gray-600">In Review</div>
                </div>
                <div class="rounded-full h-10 w-10 flex items-center justify-center bg-blue-200">
                    <i class="fas fa-search text-blue-700"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-green-100 p-4 rounded-lg shadow-sm">
            <div class="flex justify-between items-center">
                <div>
                    <div class="text-xl font-bold">{{ $approvedCount }}</div>
                    <div class="text-sm text-gray-600">Approved</div>
                </div>
                <div class="rounded-full h-10 w-10 flex items-center justify-center bg-green-200">
                    <i class="fas fa-check text-green-700"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-red-100 p-4 rounded-lg shadow-sm">
            <div class="flex justify-between items-center">
                <div>
                    <div class="text-xl font-bold">{{ $rejectedCount }}</div>
                    <div class="text-sm text-gray-600">Rejected</div>
                </div>
                <div class="rounded-full h-10 w-10 flex items-center justify-center bg-red-200">
                    <i class="fas fa-times text-red-700"></i>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Contractor List with Permits -->
    <h3 class="text-lg font-semibold mb-3">Permits by Contractor</h3>
    <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
        @if($contractors->count() > 0)
            <div class="divide-y divide-gray-200">
                @foreach($contractors as $contractor)
                    <div class="p-4 hover:bg-gray-50">
                        <div class="flex justify-between items-center mb-2">
                            <h4 class="font-medium text-lg">{{ $contractor->name }}</h4>
                            <a href="{{ route('admin.permits.contractor', $contractor) }}" class="text-blue-600 hover:text-blue-800 text-sm">
                                View All Permits
                            </a>
                        </div>
                        <div class="text-sm text-gray-500 mb-3">{{ $contractor->company_name ?? 'No company' }} | {{ $contractor->email }}</div>
                        
                        <!-- Count permits for this contractor -->
                        @php
                            $contractorPermitCount = 0;
                            foreach($contractor->projects as $project) {
                                $contractorPermitCount += $project->permits->count();
                            }
                        @endphp
                        
                        <div class="text-sm bg-gray-100 px-3 py-1 rounded-full inline-block mb-3">
                            {{ $contractorPermitCount }} {{ Str::plural('Permit', $contractorPermitCount) }}
                        </div>
                        
                        <!-- Recent Permits -->
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Permit #</th>
                                        <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                        <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Project</th>
                                        <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                        <th scope="col" class="px-3 py-2 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @php $displayedPermits = 0; @endphp
                                    
                                    @foreach($contractor->projects as $project)
                                        @foreach($project->permits->take(3 - $displayedPermits) as $permit)
                                            @php $displayedPermits++; @endphp
                                            <tr>
                                                <td class="px-3 py-2 whitespace-nowrap text-sm font-medium text-gray-900">{{ $permit->permit_number }}</td>
                                                <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-500">{{ $permit->type }}</td>
                                                <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-500">{{ Str::limit($project->name, 20) }}</td>
                                                <td class="px-3 py-2 whitespace-nowrap text-xs">
                                                    @if($permit->status == 'Pending')
                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                            Pending
                                                        </span>
                                                    @elseif($permit->status == 'In Review')
                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                            In Review
                                                        </span>
                                                    @elseif($permit->status == 'Approved')
                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                            Approved
                                                        </span>
                                                    @elseif($permit->status == 'Rejected')
                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                            Rejected
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-500">{{ $permit->submission_date->format('M d, Y') }}</td>
                                                <td class="px-3 py-2 whitespace-nowrap text-right text-sm font-medium">
                                                    <a href="{{ route('admin.permits.show', $permit) }}" class="text-blue-600 hover:text-blue-900">
                                                        View
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                    
                                    @if($displayedPermits == 0)
                                        <tr>
                                            <td colspan="6" class="px-3 py-3 text-sm text-center text-gray-500">No permits found</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="p-6 text-center text-gray-500">
                <p>No contractors with permits found.</p>
            </div>
        @endif
    </div>
</div>
@endsection 