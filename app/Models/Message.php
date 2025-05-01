<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'subject',
        'content',
        'sender_id',
        'recipient_id',
        'parent_id',
        'read_at',
        'contractor_id',
        'has_attachment'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'read_at' => 'datetime',
    ];

    /**
     * Get the sender of the message.
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    /**
     * Get the recipient of the message.
     */
    public function recipient()
    {
        return $this->belongsTo(User::class, 'recipient_id');
    }

    /**
     * Get the contractor associated with the message.
     */
    public function contractor()
    {
        return $this->belongsTo(User::class, 'contractor_id');
    }

    /**
     * Get the parent message.
     */
    public function parent()
    {
        return $this->belongsTo(Message::class, 'parent_id');
    }

    /**
     * Get the replies to this message.
     */
    public function replies()
    {
        return $this->hasMany(Message::class, 'parent_id');
    }

    /**
     * Get the documents attached to this message.
     */
    public function documents()
    {
        return $this->hasMany(Document::class, 'message_id');
    }

    /**
     * Check if the message is unread.
     */
    public function isUnread()
    {
        return $this->read_at === null;
    }

    /**
     * Mark the message as read.
     */
    public function markAsRead()
    {
        $this->read_at = now();
        $this->save();
    }
} 