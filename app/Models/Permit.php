<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Permit extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'project_id',
        'permit_number',
        'type',
        'status',
        'submission_date',
        'approval_date',
        'expiration_date',
        'description',
        'fee_amount',
        'fee_paid',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'submission_date' => 'date',
        'approval_date' => 'date',
        'expiration_date' => 'date',
        'fee_amount' => 'decimal:2',
        'fee_paid' => 'boolean',
    ];

    /**
     * Get the project that owns the permit.
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Get the documents for the permit.
     */
    public function documents(): HasMany
    {
        return $this->hasMany(Document::class);
    }

    /**
     * Get the comments for the permit.
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Get the notifications for the permit.
     */
    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class);
    }

    /**
     * Determine if the permit is approved.
     *
     * @return bool
     */
    public function isApproved(): bool
    {
        return $this->status === 'Approved';
    }

    /**
     * Determine if the permit is pending.
     *
     * @return bool
     */
    public function isPending(): bool
    {
        return $this->status === 'Pending';
    }

    /**
     * Determine if the permit is in review.
     *
     * @return bool
     */
    public function isInReview(): bool
    {
        return $this->status === 'In Review';
    }

    /**
     * Determine if the permit is rejected.
     *
     * @return bool
     */
    public function isRejected(): bool
    {
        return $this->status === 'Rejected';
    }

    /**
     * Get the days remaining until expiration.
     *
     * @return int|null
     */
    public function getDaysUntilExpiration()
    {
        if (!$this->expiration_date) {
            return null;
        }
        
        return now()->diffInDays($this->expiration_date, false);
    }
} 