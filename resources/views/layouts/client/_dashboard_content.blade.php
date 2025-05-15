<!-- Dashboard Content Partial -->
<h2 class="text-2xl font-bold mb-4">Dashboard</h2>

<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
  <div class="bg-blue-100 p-4 rounded shadow">
    <div id="active-projects-count" class="text-xl font-bold">{{ $activeProjects ?? 0 }}</div>
    <div class="text-sm text-gray-600">Active Projects</div>
  </div>
  <div class="bg-green-100 p-4 rounded shadow">
    <div id="completed-projects-count" class="text-xl font-bold">{{ $completedProjects ?? 0 }}</div>
    <div class="text-sm text-gray-600">Completed Projects</div>
  </div>
  <div class="bg-yellow-100 p-4 rounded shadow">
    <div id="pending-approvals-count" class="text-xl font-bold">{{ $pendingApprovals ?? 0 }}</div>
    <div class="text-sm text-gray-600">Pending Approvals</div>
  </div>
</div>

<!-- Permit Summary Section -->
<div class="mb-6">
  <div class="border rounded-lg overflow-hidden">
    <div class="bg-gray-50 p-4 border-b">
      <h3 class="font-bold">
        Recent Permits
        <a href="{{ route('client.permits.index') }}" class="text-sm text-blue-500 hover:underline ml-2">View All</a>
      </h3>
    </div>
    
    <div class="divide-y">
      @if(isset($recentPermits) && count($recentPermits) > 0)
        @foreach($recentPermits as $permit)
          <div class="p-4 hover:bg-gray-50">
            <a href="{{ route('client.permits.show', $permit) }}" class="block">
              <div class="flex justify-between">
                <div>
                  <span class="font-medium text-gray-800">{{ $permit->permit_number }}</span>
                  <span class="ml-2 text-sm text-gray-600">{{ $permit->type }}</span>
                </div>
                <div class="flex items-center">
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
                  <span class="text-sm text-gray-500 ml-2">{{ $permit->submission_date ? $permit->submission_date->format('M d, Y') : 'N/A' }}</span>
                </div>
              </div>
              <div class="mt-1 text-sm text-gray-600 truncate">{{ $permit->description ?? 'No description provided' }}</div>
            </a>
          </div>
        @endforeach
      @else
        <div class="p-4 text-center text-gray-500">
          No permits found. <a href="{{ route('client.permits.create') }}" class="text-blue-500 hover:underline">Submit your first permit</a>.
        </div>
      @endif
    </div>
    
    <div class="bg-gray-50 p-3 border-t text-center">
      <a href="{{ route('client.permits.create') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800">
        <i class="fas fa-plus-circle mr-1"></i> Submit New Permit
      </a>
    </div>
  </div>
</div>

<!-- Recent Messages -->
<div class="mb-6">
  <div class="border rounded-lg overflow-hidden">
    <div class="bg-gray-50 p-4 border-b">
      <h3 class="font-bold">
        Recent Messages
        <a href="{{ route('client.messages.index') }}" class="text-sm text-blue-500 hover:underline ml-2">View All</a>
      </h3>
    </div>
    
    <div class="divide-y">
      @if(isset($recentActivities) && count($recentActivities) > 0)
        @php
          // Filter activities to only show messages
          $messageActivities = array_filter($recentActivities, function($activity) {
            return $activity['type'] === 'message' || $activity['type'] === 'unread_message';
          });
          // Take only the first 5 message activities
          $messageActivities = array_slice($messageActivities, 0, 5);
        @endphp
        
        @if(count($messageActivities) > 0)
          @foreach($messageActivities as $activity)
            <div class="p-4 hover:bg-gray-50">
              <a href="{{ route('client.messages.show', $activity['messageId'] ?? 0) }}" class="block">
                <div class="flex justify-between">
                  <span class="font-medium {{ $activity['type'] === 'unread_message' ? 'text-blue-600 font-bold' : 'text-gray-800' }}">
                    @if($activity['type'] === 'unread_message')
                      <span class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none text-white bg-red-500 rounded-full">New</span>
                    @endif
                    {{ str_replace('[UNREAD] Message: ', '', $activity['message']) }}
                  </span>
                  <span class="text-sm text-gray-500">{{ $activity['date'] }}</span>
                </div>
              </a>
            </div>
          @endforeach
        @else
          <div class="p-4 text-center text-gray-500">
            No recent messages
          </div>
        @endif
      @else
        <div class="p-4 text-center text-gray-500">
          No recent messages
        </div>
      @endif
    </div>
    
    <div class="bg-gray-50 p-3 border-t text-center">
      <a href="{{ route('client.messages.create') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800">
        <i class="fas fa-plus-circle mr-1"></i> New Message
      </a>
    </div>
  </div>
</div> 