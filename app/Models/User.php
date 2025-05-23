<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'company_name',
        'phone_number',
        'company_type',
        'company_size',
        'address',
        'city',
        'state',
        'zip',
        'project_types',
        'services',
        'project_volume',
        'hear_about',
        'verification_status',
        'license_number',
        'contractor_license_file',
        'drivers_license_file',
        'insurance_certificate_file',
        'admin_feedback',
        'documents_submitted_at',
        'verified_at',
        'google_id',
        'linkedin_id',
        'contractor_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'project_types' => 'array',
        'services' => 'array',
        'documents_submitted_at' => 'datetime',
        'verified_at' => 'datetime',
    ];

    /**
     * Get the projects associated with the user.
     */
    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    /**
     * Get the permits associated with the user.
     */
    public function permits()
    {
        return $this->hasMany(Permit::class);
    }

    /**
     * Get the documents associated with the user.
     */
    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    /**
     * Get the comments created by the user.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Get all notifications for the user.
     */
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    /**
     * Get the tasks assigned to the user.
     */
    public function assignedTasks()
    {
        // Return empty collection since tasks table is deleted
        return $this->hasMany(Document::class)->whereNull('id');
    }

    /**
     * Get messages sent by the user.
     */
    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    /**
     * Get messages received by the user.
     */
    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'recipient_id');
    }

    /**
     * Get messages associated with this contractor.
     */
    public function contractorMessages()
    {
        return $this->hasMany(Message::class, 'contractor_id');
    }

    /**
     * Get invoices associated with this user.
     */
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    /**
     * Check if the user is an admin.
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Check if the user is a contractor.
     */
    public function isContractor(): bool
    {
        return $this->role === 'contractor';
    }

    /**
     * Check if the contractor is verified.
     */
    public function isVerified()
    {
        // Always return true for contractors, bypassing verification
        if ($this->isContractor()) {
            return true;
        }
        return $this->verification_status === 'approved' && $this->verified_at !== null;
    }

    /**
     * Check if documents are submitted.
     */
    public function hasSubmittedDocuments()
    {
        return $this->documents_submitted_at !== null;
    }

    /**
     * Check if the contractor is under review.
     */
    public function isUnderReview()
    {
        return $this->verification_status === 'under_review';
    }

    /**
     * Get verification status label
     */
    public function getVerificationStatusLabel()
    {
        switch ($this->verification_status) {
            case 'pending':
                return 'Missing Documents';
            case 'under_review':
                return 'Under Review';
            case 'approved':
                return 'Verified';
            case 'rejected':
                return 'Rejected';
            default:
                return 'Unknown';
        }
    }

    /**
     * Get the contractor associated with the user.
     */
    public function contractor()
    {
        return $this->belongsTo(Contractor::class);
    }
}
