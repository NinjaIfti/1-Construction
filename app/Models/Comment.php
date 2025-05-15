<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Comment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'permit_id',
        'user_id',
        'content',
        'is_admin_comment',
        'commentable_id',
        'commentable_type'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_admin_comment' => 'boolean',
    ];

    /**
     * Get the parent commentable model.
     */
    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get the permit that owns the comment.
     */
    public function permit(): BelongsTo
    {
        return $this->belongsTo(Permit::class);
    }

    /**
     * Get the user that owns the comment.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Determine if the comment is from an admin.
     */
    public function isAdminComment(): bool
    {
        return $this->is_admin_comment;
    }

    /**
     * Get short version of comment content.
     */
    public function getShortContentAttribute(): string
    {
        if (strlen($this->content) <= 100) {
            return $this->content;
        }
        
        return substr($this->content, 0, 100) . '...';
    }
} 