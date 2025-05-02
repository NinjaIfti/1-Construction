<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'project_id',
        'user_id',
        'title',
        'description',
        'status',
        'priority',
        'due_date',
        'completed_at',
        'assigned_to',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'due_date' => 'date',
        'completed_at' => 'datetime',
    ];

    /**
     * Get the project that owns the task.
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Get the user assigned to the task.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the user this task is assigned to.
     */
    public function assignedUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    /**
     * Determine if the task is completed.
     */
    public function isCompleted(): bool
    {
        return $this->status === 'Completed';
    }

    /**
     * Determine if the task is overdue.
     */
    public function isOverdue(): bool
    {
        return !$this->isCompleted() && $this->due_date && $this->due_date->isPast();
    }

    /**
     * Get days remaining until the due date.
     */
    public function getDaysRemainingAttribute(): ?int
    {
        if (!$this->due_date) {
            return null;
        }

        if ($this->due_date->isPast()) {
            return -1 * now()->diffInDays($this->due_date);
        }

        return now()->diffInDays($this->due_date);
    }

    /**
     * Mark the task as completed.
     */
    public function markAsCompleted(): void
    {
        $this->update([
            'status' => 'Completed',
            'completed_at' => now(),
        ]);
    }

    /**
     * Mark the task as in progress.
     */
    public function markAsInProgress(): void
    {
        $this->update([
            'status' => 'In Progress',
            'completed_at' => null,
        ]);
    }

    /**
     * Scope a query to only include high priority tasks.
     */
    public function scopeHighPriority($query)
    {
        return $query->where('priority', 'High');
    }

    /**
     * Scope a query to only include tasks due today.
     */
    public function scopeDueToday($query)
    {
        return $query->whereDate('due_date', now());
    }

    /**
     * Scope a query to only include overdue tasks.
     */
    public function scopeOverdue($query)
    {
        return $query->where('status', '!=', 'Completed')
                     ->whereNotNull('due_date')
                     ->whereDate('due_date', '<', now());
    }
} 