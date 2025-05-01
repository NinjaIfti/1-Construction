@extends('layouts.admin.dashboard')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-navy">Messages</h1>
        <a href="{{ route('admin.messages.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 3a1 1 0 00-1 1v5H4a1 1 0 100 2h5v5a1 1 0 102 0v-5h5a1 1 0 100-2h-5V4a1 1 0 00-1-1z" clip-rule="evenodd" />
            </svg>
            New Message
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

    <div class="bg-white shadow overflow-hidden rounded-lg">
        <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Messages by Contractor</h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">View and manage messages organized by contractor</p>
        </div>
        
        @if($contractors->count() > 0)
            <div class="bg-white">
                <ul class="divide-y divide-gray-200">
                    @foreach($contractors as $contractor)
                        <li>
                            <a href="{{ route('admin.messages.contractor', $contractor) }}" class="block hover:bg-gray-50">
                                <div class="px-4 py-4 sm:px-6">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0">
                                                <span class="inline-flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 text-blue-800">
                                                    <span class="text-lg font-medium">{{ substr($contractor->name, 0, 1) }}</span>
                                                </span>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $contractor->name }}</div>
                                                <div class="text-sm text-gray-500">{{ $contractor->company_name }}</div>
                                            </div>
                                        </div>
                                        <div class="flex items-center">
                                            <div class="mr-4 flex flex-col items-end text-sm text-gray-500">
                                                <div>{{ $contractor->contractorMessages->count() }} messages</div>
                                                @php
                                                    $unreadCount = $contractor->contractorMessages->where('recipient_id', auth()->id())->where('read_at', null)->count();
                                                @endphp
                                                @if($unreadCount > 0)
                                                    <div class="text-green-600 font-medium">{{ $unreadCount }} unread</div>
                                                @endif
                                            </div>
                                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @else
            <div class="px-4 py-10 sm:px-6 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No messages</h3>
                <p class="mt-1 text-sm text-gray-500">Get started by creating a new message.</p>
                <div class="mt-6">
                    <a href="{{ route('admin.messages.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 00-1 1v5H4a1 1 0 100 2h5v5a1 1 0 102 0v-5h5a1 1 0 100-2h-5V4a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        New Message
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>

<script>
    // Fetch unread message count every 30 seconds for notification badge update
    function updateUnreadCount() {
        fetch("{{ route('admin.api.messages.unread') }}")
            .then(response => response.json())
            .then(data => {
                const badge = document.getElementById('message-badge');
                if (badge) {
                    if (data.count > 0) {
                        badge.textContent = data.count;
                        badge.classList.remove('hidden');
                    } else {
                        badge.classList.add('hidden');
                    }
                }
            });
    }
    
    // Initial update
    updateUnreadCount();
    
    // Set interval for updates
    setInterval(updateUnreadCount, 30000);
</script>
@endsection 