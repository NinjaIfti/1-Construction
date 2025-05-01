@extends('layouts.admin.dashboard')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-navy">{{ $message->subject }}</h1>
            <p class="text-gray-500 mt-1">
                {{ $message->parent_id ? 'Conversation with' : 'Message with' }} 
                {{ auth()->id() == $message->sender_id ? $message->recipient->name : $message->sender->name }}
                @if($message->contractor)
                    ({{ $message->contractor->company_name }})
                @endif
            </p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('admin.messages.reply', $message) }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M7.707 3.293a1 1 0 010 1.414L5.414 7H11a7 7 0 017 7v2a1 1 0 11-2 0v-2a5 5 0 00-5-5H5.414l2.293 2.293a1 1 0 11-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
                Reply
            </a>
            @if($message->contractor)
                <a href="{{ route('admin.messages.contractor', $message->contractor) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Back to {{ $message->contractor->name }}'s Messages
                </a>
            @else
                <a href="{{ route('admin.messages.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Back to Messages
                </a>
            @endif
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-6">
        <div class="px-4 py-5 sm:px-6 bg-gray-50 border-b">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Message Details</h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                        {{ $message->created_at->format('F j, Y, g:i a') }}
                    </p>
                </div>
                <div>
                    @if($message->sender_id != auth()->id())
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $message->read_at ? 'bg-gray-100 text-gray-800' : 'bg-green-100 text-green-800' }}">
                            {{ $message->read_at ? 'Read' : 'Unread' }}
                        </span>
                    @else
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                            Sent
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="space-y-6">
        @foreach($conversation as $msg)
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-4 sm:px-6 bg-gray-50 border-b flex justify-between items-center">
                    <div>
                        <h3 class="text-md font-medium text-gray-900">
                            {{ $msg->sender->name }}
                            <span class="text-sm text-gray-500 ml-1">({{ $msg->sender->role }})</span>
                        </h3>
                        <p class="mt-1 max-w-2xl text-sm text-gray-500">
                            {{ $msg->created_at->format('F j, Y, g:i a') }}
                        </p>
                    </div>
                    <div>
                        @if($msg->id != $message->id)
                            <span class="text-sm text-gray-500">
                                {{ $msg->subject }}
                            </span>
                        @endif
                    </div>
                </div>
                <div class="px-4 py-5 sm:p-6 border-b">
                    <div class="prose max-w-none">
                        {!! nl2br(e($msg->content)) !!}
                    </div>
                </div>
                
                @if($msg->has_attachment)
                    <div class="px-4 py-4 sm:px-6 bg-gray-50 border-t">
                        <h4 class="text-sm font-medium text-gray-900 mb-2">Attachments:</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($msg->documents as $document)
                                <div class="flex items-center space-x-2 p-2 border rounded-md bg-white">
                                    <div class="flex-shrink-0">
                                        @if($document->isPdf())
                                            <svg class="h-8 w-8 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M19 3H5C3.9 3 3 3.9 3 5V19C3 20.1 3.9 21 5 21H19C20.1 21 21 20.1 21 19V5C21 3.9 20.1 3 19 3M9.5 11.5C9.5 12.3 8.8 13 8 13H7V15H5.5V9H8C8.8 9 9.5 9.7 9.5 10.5V11.5M14.5 13.5C14.5 14.3 13.8 15 13 15H10.5V9H13C13.8 9 14.5 9.7 14.5 10.5V13.5M18.5 10.5H17V11.5H18.5V13H17V15H15.5V9H18.5V10.5M7 10.5H8V11.5H7V10.5M12 10.5H13V13.5H12V10.5Z" />
                                            </svg>
                                        @elseif($document->isImage())
                                            <svg class="h-8 w-8 text-blue-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M19,19H5V5H19M19,3H5A2,2 0 0,0 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V5A2,2 0 0,0 19,3M13.96,12.29L11.21,15.83L9.25,13.47L6.5,17H17.5L13.96,12.29Z" />
                                            </svg>
                                        @else
                                            <svg class="h-8 w-8 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z" />
                                            </svg>
                                        @endif
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <p class="text-sm font-medium text-gray-900 truncate">
                                            {{ $document->name }}
                                        </p>
                                        <p class="text-xs text-gray-500">
                                            {{ $document->getFormattedFileSizeAttribute() }}
                                        </p>
                                    </div>
                                    <div>
                                        <a href="{{ route('admin.documents.download', $document) }}" class="inline-flex items-center p-1.5 border border-transparent rounded-full shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</div>
@endsection 