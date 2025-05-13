<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'invoice_number',
        'user_id',
        'contractor_id',
        'amount',
        'description',
        'status',
        'due_date',
        'paid_at',
        'notes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'due_date' => 'date',
        'paid_at' => 'datetime',
    ];

    /**
     * Get the contractor that owns the invoice.
     */
    public function contractor()
    {
        return $this->belongsTo(Contractor::class);
    }

    /**
     * Get the contractor that owns the invoice.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Check if invoice is paid.
     *
     * @return bool
     */
    public function isPaid()
    {
        return $this->status === 'paid';
    }

    /**
     * Check if invoice is overdue.
     *
     * @return bool
     */
    public function isOverdue()
    {
        return !$this->isPaid() && now()->gt($this->due_date);
    }
}
