@extends('layouts.admin.dashboard')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Create New Invoice</h1>
        <a href="{{ route('admin.invoices.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
            <i class="fas fa-arrow-left mr-2"></i>Back to Invoices
        </a>
    </div>

    <div class="bg-white shadow rounded-lg p-6">
        <form action="{{ route('admin.invoices.store') }}" method="POST">
            @csrf

            <!-- Contractor Selection -->
            <div class="mb-6">
                <label for="contractor_id" class="block text-sm font-medium text-gray-700 mb-1">Contractor</label>
                <select name="contractor_id" id="contractor_id" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="">Select a Contractor</option>
                    @foreach($contractors as $contractor)
                        <option value="{{ $contractor->id }}" {{ old('contractor_id') == $contractor->id ? 'selected' : '' }}>
                            {{ $contractor->company_name }}
                        </option>
                    @endforeach
                </select>
                @error('contractor_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Invoice Details -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="invoice_number" class="block text-sm font-medium text-gray-700 mb-1">Invoice Number</label>
                    <input type="text" name="invoice_number" id="invoice_number" value="{{ old('invoice_number') }}" required
                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('invoice_number')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="amount" class="block text-sm font-medium text-gray-700 mb-1">Amount ($)</label>
                    <input type="number" name="amount" id="amount" value="{{ old('amount') }}" step="0.01" required
                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('amount')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="due_date" class="block text-sm font-medium text-gray-700 mb-1">Due Date</label>
                    <input type="date" name="due_date" id="due_date" value="{{ old('due_date') }}" required
                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('due_date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" id="status" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="paid" {{ old('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                        <option value="overdue" {{ old('status') == 'overdue' ? 'selected' : '' }}>Overdue</option>
                    </select>
                    @error('status')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Description -->
            <div class="mb-6">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="description" id="description" rows="4" required
                          class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    <i class="fas fa-save mr-2"></i>Create Invoice
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 