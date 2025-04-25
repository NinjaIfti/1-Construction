<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'user_id',
        'address',
        'city',
        'state',
        'zip_code',
        'status',
        'start_date',
        'end_date',
        'description',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    /**
     * Get the user that owns the project.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the permits for the project.
     */
    public function permits(): HasMany
    {
        return $this->hasMany(Permit::class);
    }

    /**
     * Get the tasks for the project.
     */
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    /**
     * Get the project's full address.
     */
    public function getFullAddressAttribute(): string
    {
        return "{$this->address}, {$this->city}, {$this->state} {$this->zip_code}";
    }

    /**
     * Determine if the project is active.
     */
    public function isActive(): bool
    {
        return $this->status === 'Active';
    }

    /**
     * Determine if the project is completed.
     */
    public function isCompleted(): bool
    {
        return $this->status === 'Completed';
    }

    /**
     * Get the percentage of completed permits.
     */
    public function getPermitCompletionPercentage(): int
    {
        $totalPermits = $this->permits()->count();
        
        if ($totalPermits === 0) {
            return 0;
        }
        
        $approvedPermits = $this->permits()->where('status', 'Approved')->count();
        
        return (int) (($approvedPermits / $totalPermits) * 100);
    }
} 