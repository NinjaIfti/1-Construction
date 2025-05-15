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
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'permit_type',
        'status',
        'submission_date',
        'approved_date',
        'expiration_date',
        'permit_number',
        'issuing_authority',
        'project_id',
        'type',
        'admin_notes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'submission_date' => 'date',
        'approved_date' => 'date',
        'expiration_date' => 'date',
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
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
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
     * Determine if the permit is rejected.
     *
     * @return bool
     */
    public function isRejected(): bool
    {
        return $this->status === 'Rejected';
    }

    /**
     * Get the approval date attribute accessor.
     * This provides compatibility for code that still uses approval_date.
     *
     * @return \Carbon\Carbon|null
     */
    public function getApprovalDateAttribute()
    {
        return $this->approved_date;
    }

    /**
     * Set the approval date attribute mutator.
     * This provides compatibility for code that still uses approval_date.
     *
     * @param mixed $value
     * @return void
     */
    public function setApprovalDateAttribute($value)
    {
        $this->attributes['approved_date'] = $value;
    }
} 