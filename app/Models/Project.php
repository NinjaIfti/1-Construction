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
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'address',
        'city',
        'state',
        'zip',
        'project_type',
        'status',
        'start_date',
        'end_date',
        'user_id',
        'contractor_id',
        'budget',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'budget' => 'decimal:2',
    ];

    /**
     * The relationships that should be eager loaded.
     *
     * @var array
     */
    protected $with = ['contractor'];

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
        // Since the tasks table is deleted, return an empty collection
        return $this->hasMany(Document::class)->whereNull('id');
    }

    /**
     * Get the project's full address.
     */
    public function getFullAddressAttribute(): string
    {
        return "{$this->address}, {$this->city}, {$this->state} {$this->zip}";
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

    /**
     * Get the contractor for the project.
     */
    public function contractor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'contractor_id')->where('role', 'contractor');
    }

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();
        
        // Always eager load the contractor relationship when getting permits
        static::with(['contractor']);
    }
} 