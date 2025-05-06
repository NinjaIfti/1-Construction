@extends('layouts.admin.dashboard')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Invoice Details</h1>
        <div class="flex space-x-4">
            <a href="{{ route('admin.invoices.edit', $invoice) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                <i class="fas fa-edit mr-2"></i>Edit Invoice
            </a>
            <a href="{{ route('admin.invoices.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                <i class="fas fa-arrow-left mr-2"></i>Back to Invoices
            </a>
        </div>
    </div>

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <!-- Invoice Header -->
        <div class="p-6 border-b border-gray-200">
            <div class="flex justify-between items-start">
                <div>
                    <h2 class="text-xl font-semibold text-gray-800">Invoice #{{ $invoice->invoice_number }}</h2>
                    <p class="text-gray-600 mt-1">Created on {{ $invoice->created_at->format('M d, Y') }}</p>
                </div>
                <div class="text-right">
                    <span class="px-3 py-1 rounded-full text-sm font-semibold
                        {{ $invoice->status === 'paid' ? 'bg-green-100 text-green-800' : 
                           ($invoice->status === 'overdue' ? 'bg-red-100 text-red-800' : 
                            'bg-yellow-100 text-yellow-800') }}">
                        {{ ucfirst($invoice->status) }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Invoice Details -->
        <div class="p-6 border-b border-gray-200">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Contractor Information</h3>
                    <div class="space-y-2">
                        <p class="text-gray-600">
                            <span class="font-medium">Company:</span> {{ $invoice->contractor->company_name }}
                        </p>
                        <p class="text-gray-600">
                            <span class="font-medium">Contact:</span> {{ $invoice->contractor->name }}
                        </p>
                        <p class="text-gray-600">
                            <span class="font-medium">Email:</span> {{ $invoice->contractor->email }}
                        </p>
                    </div>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Invoice Information</h3>
                    <div class="space-y-2">
                        <p class="text-gray-600">
                            <span class="font-medium">Due Date:</span> {{ $invoice->due_date->format('M d, Y') }}
                        </p>
                        <p class="text-gray-600">
                            <span class="font-medium">Amount:</span> ${{ number_format($invoice->amount, 2) }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Invoice Description -->
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Description</h3>
            <p class="text-gray-600">{{ $invoice->description }}</p>
        </div>

        <!-- Invoice Actions -->
        <div class="p-6 bg-gray-50">
            <div class="flex justify-end space-x-4">
                @if($invoice->status !== 'paid')
                    <form action="{{ route('admin.invoices.mark-paid', $invoice) }}" method="POST" class="inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            <i class="fas fa-check mr-2"></i>Mark as Paid
                        </button>
                    </form>
                @endif
                <form action="{{ route('admin.invoices.destroy', $invoice) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Are you sure you want to delete this invoice?')">
                        <i class="fas fa-trash mr-2"></i>Delete Invoice
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 