<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Pay Invoice') }}
            </h2>
            <a href="{{ route('client.invoices.show', $invoice) }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Back to Invoice') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Invoice Details</h3>
                        <div class="bg-gray-50 p-4 rounded-md">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm text-gray-500">Invoice Number</p>
                                    <p class="text-lg font-medium">{{ $invoice->invoice_number }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Amount Due</p>
                                    <p class="text-lg font-medium">${{ number_format($invoice->amount, 2) }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Due Date</p>
                                    <p class="text-lg font-medium">{{ $invoice->due_date->format('F d, Y') }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Status</p>
                                    <p class="text-lg font-medium">
                                        @if($invoice->status === 'overdue')
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                                Overdue
                                            </span>
                                        @else
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                Pending
                                            </span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="mt-4">
                                <p class="text-sm text-gray-500">Description</p>
                                <p class="text-md">{{ $invoice->description }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-10">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Payment Method</h3>
                        
                        <form method="POST" action="{{ route('client.invoices.process-payment', $invoice) }}" class="space-y-6">
                            @csrf
                            
                            <!-- Payment Form (in a real application, you'd integrate with a payment gateway) -->
                            <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-4">
                                <div class="sm:col-span-2">
                                    <label for="card-number" class="block text-sm font-medium text-gray-700">Card number</label>
                                    <div class="mt-1">
                                        <input type="text" id="card-number" name="card-number" placeholder="1234 1234 1234 1234" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    </div>
                                </div>

                                <div>
                                    <label for="expiration-date" class="block text-sm font-medium text-gray-700">Expiration date (MM/YY)</label>
                                    <div class="mt-1">
                                        <input type="text" id="expiration-date" name="expiration-date" placeholder="MM / YY" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    </div>
                                </div>

                                <div>
                                    <label for="cvc" class="block text-sm font-medium text-gray-700">CVC</label>
                                    <div class="mt-1">
                                        <input type="text" id="cvc" name="cvc" placeholder="123" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    </div>
                                </div>
                                
                                <div class="sm:col-span-2">
                                    <label for="name-on-card" class="block text-sm font-medium text-gray-700">Name on card</label>
                                    <div class="mt-1">
                                        <input type="text" id="name-on-card" name="name-on-card" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-6 flex justify-end">
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Pay ${{ number_format($invoice->amount, 2) }}
                                </button>
                            </div>
                            
                            <div class="mt-2 text-sm text-gray-500 text-center">
                                <p>This is a demo payment form. No actual payment will be processed.</p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 