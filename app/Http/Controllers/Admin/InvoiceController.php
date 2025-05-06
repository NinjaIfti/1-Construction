<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Contractor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Carbon\Carbon;

class InvoiceController extends Controller
{
    /**
     * Display a listing of all invoices.
     */
    public function index(Request $request)
    {
        $query = Invoice::with('contractor');

        // Filter by status
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        // Filter by contractor
        if ($request->has('contractor_id') && $request->contractor_id !== '') {
            $query->where('contractor_id', $request->contractor_id);
        }

        $invoices = $query->latest()->paginate(10);
        $contractors = Contractor::orderBy('company_name')->get();

        return view('layouts.admin.invoices.index', compact('invoices', 'contractors'));
    }

    /**
     * Show the form for creating a new invoice.
     */
    public function create()
    {
        $contractors = Contractor::orderBy('company_name')->get();
        return view('layouts.admin.invoices.create', compact('contractors'));
    }

    /**
     * Store a newly created invoice in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'contractor_id' => 'required|exists:contractors,id',
            'invoice_number' => 'required|string|max:255|unique:invoices',
            'amount' => 'required|numeric|min:0',
            'due_date' => 'required|date|after:today',
            'status' => 'required|in:pending,paid,overdue',
            'description' => 'required|string',
        ]);

        try {
            DB::beginTransaction();

            $invoice = Invoice::create($validated);

            // Create notification for contractor
            $invoice->contractor->notifications()->create([
                'title' => 'New Invoice',
                'message' => "A new invoice #{$invoice->invoice_number} has been created for you.",
                'type' => 'invoice',
                'data' => ['invoice_id' => $invoice->id],
            ]);

            DB::commit();

            return redirect()
                ->route('admin.invoices.show', $invoice)
                ->with('success', 'Invoice created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Invoice creation failed: ' . $e->getMessage());
            return back()->with('error', 'Failed to create invoice. Please try again.');
        }
    }

    /**
     * Display the specified invoice.
     */
    public function show(Invoice $invoice)
    {
        return view('layouts.admin.invoices.show', compact('invoice'));
    }

    /**
     * Show the form for editing the specified invoice.
     */
    public function edit(Invoice $invoice)
    {
        $contractors = Contractor::orderBy('company_name')->get();
        return view('layouts.admin.invoices.edit', compact('invoice', 'contractors'));
    }

    /**
     * Update the specified invoice in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        $validated = $request->validate([
            'contractor_id' => 'required|exists:contractors,id',
            'invoice_number' => 'required|string|max:255|unique:invoices,invoice_number,' . $invoice->id,
            'amount' => 'required|numeric|min:0',
            'due_date' => 'required|date',
            'status' => 'required|in:pending,paid,overdue',
            'description' => 'required|string',
        ]);

        try {
            DB::beginTransaction();

            $oldStatus = $invoice->status;
            $invoice->update($validated);

            // If status changed to paid, update paid_at
            if ($validated['status'] === 'paid' && $oldStatus !== 'paid') {
                $invoice->update(['paid_at' => now()]);
            }

            // Create notification for contractor if status changed
            if ($oldStatus !== $validated['status']) {
                $invoice->contractor->notifications()->create([
                    'title' => 'Invoice Status Updated',
                    'message' => "Invoice #{$invoice->invoice_number} status has been updated to {$validated['status']}.",
                    'type' => 'invoice',
                    'data' => ['invoice_id' => $invoice->id],
                ]);
            }

            DB::commit();

            return redirect()
                ->route('admin.invoices.show', $invoice)
                ->with('success', 'Invoice updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Invoice update failed: ' . $e->getMessage());
            return back()->with('error', 'Failed to update invoice. Please try again.');
        }
    }

    /**
     * Mark invoice as paid.
     */
    public function markAsPaid(Invoice $invoice)
    {
        try {
            DB::beginTransaction();

            $invoice->update([
                'status' => 'paid',
                'paid_at' => now(),
            ]);

            // Create notification for contractor
            $invoice->contractor->notifications()->create([
                'title' => 'Invoice Paid',
                'message' => "Invoice #{$invoice->invoice_number} has been marked as paid.",
                'type' => 'invoice',
                'data' => ['invoice_id' => $invoice->id],
            ]);

            DB::commit();

            return redirect()
                ->route('admin.invoices.show', $invoice)
                ->with('success', 'Invoice marked as paid successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Mark invoice as paid failed: ' . $e->getMessage());
            return back()->with('error', 'Failed to mark invoice as paid. Please try again.');
        }
    }

    /**
     * Remove the specified invoice from storage.
     */
    public function destroy(Invoice $invoice)
    {
        try {
            DB::beginTransaction();

            // Create notification for contractor
            $invoice->contractor->notifications()->create([
                'title' => 'Invoice Deleted',
                'message' => "Invoice #{$invoice->invoice_number} has been deleted.",
                'type' => 'invoice',
                'data' => ['invoice_id' => $invoice->id],
            ]);

            $invoice->delete();

            DB::commit();

            return redirect()
                ->route('admin.invoices.index')
                ->with('success', 'Invoice deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Invoice deletion failed: ' . $e->getMessage());
            return back()->with('error', 'Failed to delete invoice. Please try again.');
        }
    }

    /**
     * Get contractor's invoices.
     */
    public function contractorInvoices(Contractor $contractor)
    {
        $invoices = $contractor->invoices()->latest()->paginate(10);
        return view('layouts.admin.invoices.contractor', compact('invoices', 'contractor'));
    }
}
