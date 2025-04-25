<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'permit_id',
        'title',
        'message',
        'type',
        'read',
        'email_sent',
        'sms_sent',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'read' => 'boolean',
        'email_sent' => 'boolean',
        'sms_sent' => 'boolean',
    ];

    /**
     * Get the user that owns the notification.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the permit associated with the notification.
     */
    public function permit(): BelongsTo
    {
        return $this->belongsTo(Permit::class);
    }

    /**
     * Determine if the notification is read.
     */
    public function isRead(): bool
    {
        return $this->read;
    }

    /**
     * Mark the notification as read.
     */
    public function markAsRead(): void
    {
        $this->update(['read' => true]);
    }

    /**
     * Mark the notification as unread.
     */
    public function markAsUnread(): void
    {
        $this->update(['read' => false]);
    }

    /**
     * Scope a query to only include unread notifications.
     */
    public function scopeUnread($query)
    {
        return $query->where('read', false);
    }
    
    /**
     * Determine if notification is for status change.
     */
    public function isStatusChange(): bool
    {
        return $this->type === 'status_change';
    }
    
    /**
     * Determine if notification is for a comment.
     */
    public function isComment(): bool
    {
        return $this->type === 'comment';
    }
    
    /**
     * Determine if notification is for a deadline.
     */
    public function isDeadline(): bool
    {
        return $this->type === 'deadline';
    }
} 