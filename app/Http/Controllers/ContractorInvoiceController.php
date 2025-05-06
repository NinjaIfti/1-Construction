<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContractorInvoiceController extends Controller
{
    /**
     * Display a listing of the contractor's invoices.
     */
    public function index()
    {
        $invoices = Auth::user()->invoices()->latest()->paginate(10);
        return view('layouts.client.invoices.index', compact('invoices'));
    }

    /**
     * Display the specified invoice.
     */
    public function show(Invoice $invoice)
    {
        // Make sure contractor can only view their own invoices
        if ($invoice->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('layouts.client.invoices.show', compact('invoice'));
    }

    /**
     * Display invoice payment page.
     */
    public function paymentForm(Invoice $invoice)
    {
        // Make sure contractor can only pay their own invoices
        if ($invoice->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        if ($invoice->isPaid()) {
            return redirect()->route('client.invoices.show', $invoice)
                ->with('info', 'This invoice has already been paid.');
        }

        return view('layouts.client.invoices.payment', compact('invoice'));
    }

    /**
     * Process invoice payment.
     */
    public function processPayment(Request $request, Invoice $invoice)
    {
        // Make sure contractor can only pay their own invoices
        if ($invoice->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        if ($invoice->isPaid()) {
            return redirect()->route('client.invoices.show', $invoice)
                ->with('info', 'This invoice has already been paid.');
        }

        // Here you would integrate with a payment gateway
        // For now, we'll just mark it as paid

        $invoice->update([
            'status' => 'paid',
            'paid_at' => now(),
        ]);

        // Create notification for admin
        $admin = \App\Models\User::where('role', 'admin')->first();
        if ($admin) {
            $admin->notifications()->create([
                'title' => 'Invoice Payment',
                'message' => 'Invoice ' . $invoice->invoice_number . ' has been paid by ' . Auth::user()->name,
                'type' => 'invoice_payment',
                'read' => false,
            ]);
        }

        return redirect()->route('client.invoices.index')
            ->with('success', 'Payment processed successfully.');
    }
}
