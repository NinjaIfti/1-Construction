<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Invoices for') }} {{ $contractor->name }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('admin.invoices.create', ['contractor_id' => $contractor->id]) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ __('Create Invoice') }}
                </a>
                <a href="{{ route('admin.contractors.show', $contractor) }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ __('Back to Contractor') }}
                </a>
                <a href="{{ route('admin.invoices.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ __('All Invoices') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(session('success'))
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif

                    <!-- Contractor Info Card -->
                    <div class="mb-6 bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-lg font-medium text-gray-900">Contractor Information</h3>
                        <div class="mt-2 grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Name</p>
                                <p class="text-base text-gray-900">{{ $contractor->name }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Email</p>
                                <p class="text-base text-gray-900">{{ $contractor->email }}</p>
                            </div>
                            @if($contractor->company_name)
                            <div>
                                <p class="text-sm font-medium text-gray-500">Company</p>
                                <p class="text-base text-gray-900">{{ $contractor->company_name }}</p>
                            </div>
                            @endif
                            @if($contractor->phone_number)
                            <div>
                                <p class="text-sm font-medium text-gray-500">Phone</p>
                                <p class="text-base text-gray-900">{{ $contractor->phone_number }}</p>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Invoices Table -->
                    @if($invoices->count() > 0)
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Invoices</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white">
                                <thead>
                                    <tr>
                                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Invoice #</th>
                                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Amount</th>
                                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Due Date</th>
                                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($invoices as $invoice)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                                <div class="text-sm leading-5 font-medium text-gray-900">{{ $invoice->invoice_number }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                                <div class="text-sm leading-5 text-gray-900">${{ number_format($invoice->amount, 2) }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                                <div class="text-sm leading-5 text-gray-900">{{ $invoice->due_date->format('M d, Y') }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                                @if($invoice->status === 'paid')
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                        Paid
                                                    </span>
                                                @elseif($invoice->status === 'overdue')
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                        Overdue
                                                    </span>
                                                @elseif($invoice->status === 'cancelled')
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                        Cancelled
                                                    </span>
                                                @else
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                        Pending
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 font-medium">
                                                <div class="flex space-x-2">
                                                    <a href="{{ route('admin.invoices.show', $invoice) }}" class="text-blue-600 hover:text-blue-900">View</a>
                                                    <a href="{{ route('admin.invoices.edit', $invoice) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                                    @if($invoice->status !== 'paid')
                                                        <form action="{{ route('admin.invoices.mark-paid', $invoice) }}" method="POST" class="inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="text-green-600 hover:text-green-900">Mark Paid</button>
                                                        </form>
                                                    @endif
                                                    <form action="{{ route('admin.invoices.destroy', $invoice) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this invoice?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            {{ $invoices->links() }}
                        </div>
                    @else
                        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-yellow-700">
                                        No invoices found for this contractor.
                                        <a href="{{ route('admin.invoices.create', ['contractor_id' => $contractor->id]) }}" class="font-medium underline text-yellow-700 hover:text-yellow-600">
                                            Create an invoice
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 