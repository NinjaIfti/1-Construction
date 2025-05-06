<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Contractor extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'company_name',
        'address',
        'city',
        'state',
        'zip_code',
        'country',
        'tax_id',
        'status',
    ];

    /**
     * Get the invoices for the contractor.
     */
    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    /**
     * Get the notifications for the contractor.
     */
    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class);
    }
} 