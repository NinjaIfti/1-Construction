<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Invoice;
use Carbon\Carbon;
use App\Models\User;

class CheckOverdueInvoices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'invoices:check-overdue';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for overdue invoices and mark them accordingly';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::today();
        
        // Find all unpaid invoices that are past their due date
        $overdueInvoices = Invoice::where('status', 'pending')
            ->where('due_date', '<', $today)
            ->get();
        
        $count = $overdueInvoices->count();
        
        if ($count > 0) {
            $this->info("Found {$count} overdue invoices.");
            
            foreach ($overdueInvoices as $invoice) {
                $invoice->update([
                    'status' => 'overdue'
                ]);
                
                // Create notification for contractor
                $user = User::find($invoice->user_id);
                $user->notifications()->create([
                    'title' => 'Invoice Overdue',
                    'message' => "Invoice {$invoice->invoice_number} is now overdue. Due date was {$invoice->due_date->format('M d, Y')}.",
                    'type' => 'invoice_overdue',
                    'read' => false,
                ]);
                
                $this->line("Marked invoice #{$invoice->invoice_number} as overdue for {$user->name}.");
            }
            
            // Create notification for admin
            $admin = User::where('role', 'admin')->first();
            if ($admin) {
                $admin->notifications()->create([
                    'title' => 'Overdue Invoices',
                    'message' => "{$count} invoices are now marked as overdue.",
                    'type' => 'invoices_overdue',
                    'read' => false,
                ]);
            }
            
            $this->info("Successfully processed {$count} overdue invoices.");
        } else {
            $this->info("No overdue invoices found.");
        }
        
        return 0;
    }
}
