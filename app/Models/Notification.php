<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

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
        'title',
        'message',
        'type',
        'url',
        'read',
        'related_id',
        'related_type'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'read' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user that owns the notification.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the related model for this notification.
     */
    public function related()
    {
        return $this->morphTo('related');
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