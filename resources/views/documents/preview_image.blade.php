@if($document->file_type === 'image/jpeg' || $document->file_type === 'image/png' || $document->file_type === 'image/jpg')
    <img src="{{ Storage::url($document->file_path) }}" alt="{{ $document->name }}" class="max-w-full h-auto rounded-lg shadow-md">
@elseif($document->file_type === 'application/pdf')
    <div class="bg-gray-100 p-4 rounded-lg text-center">
        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
        </svg>
        <p class="mt-2 text-sm text-gray-600">PDF Document</p>
        <a href="{{ route('documents.download', $document) }}" class="mt-2 inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            Download PDF
        </a>
    </div>
@else
    <div class="bg-gray-100 p-4 rounded-lg text-center">
        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
        </svg>
        <p class="mt-2 text-sm text-gray-600">{{ $document->name }}</p>
        <a href="{{ route('documents.download', $document) }}" class="mt-2 inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            Download File
        </a>
    </div>
@endif 