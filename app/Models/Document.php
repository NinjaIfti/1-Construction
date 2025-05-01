<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Document extends Model
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
        'file_path',
        'file_size',
        'file_type',
        'status',
        'uploaded_by',
        'permit_id',
        'is_approved',
        'approved_at',
        'approved_by',
        'folder_id',
        'user_id',
        'contractor_id',
        'document_status',
        'message_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'file_size' => 'integer',
        'is_approved' => 'boolean',
        'approved_at' => 'datetime',
    ];

    /**
     * Get the permit that owns the document.
     */
    public function permit(): BelongsTo
    {
        return $this->belongsTo(Permit::class);
    }

    /**
     * Get the user who uploaded the document.
     */
    public function uploader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    /**
     * Get the user who approved the document.
     */
    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /**
     * Get the document's download URL.
     */
    public function getDownloadUrlAttribute(): string
    {
        return Storage::url($this->file_path);
    }

    /**
     * Get the file extension.
     */
    public function getExtensionAttribute(): string
    {
        return pathinfo($this->file_path, PATHINFO_EXTENSION);
    }

    /**
     * Determine if the document is an image.
     */
    public function isImage(): bool
    {
        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg', 'webp'];
        return in_array($this->extension, $imageExtensions);
    }

    /**
     * Determine if the document is a PDF.
     */
    public function isPdf(): bool
    {
        return $this->extension === 'pdf';
    }

    /**
     * Format the file size for display.
     */
    public function getFormattedFileSizeAttribute(): string
    {
        $bytes = $this->file_size;
        
        if ($bytes >= 1073741824) {
            return number_format($bytes / 1073741824, 2) . ' GB';
        }
        
        if ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        }
        
        if ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        }
        
        return $bytes . ' bytes';
    }

    /**
     * Get the message that this document is attached to.
     */
    public function message(): BelongsTo
    {
        return $this->belongsTo(Message::class, 'message_id');
    }

    /**
     * Get the folder path for the document.
     */
    public function getFolderPathAttribute(): string
    {
        if ($this->permit_id) {
            return 'permits/' . $this->permit_id;
        } elseif ($this->contractor_id) {
            return 'contractors/' . $this->contractor_id;
        } elseif ($this->message_id) {
            return 'messages/' . $this->message_id;
        }

        return 'documents';
    }

    /**
     * Get full storage path for the document.
     */
    public function getStoragePathAttribute(): string
    {
        return storage_path('app/public/' . $this->file_path);
    }

    /**
     * Get the folder that contains the document.
     */
    public function folder(): BelongsTo
    {
        return $this->belongsTo(DocumentFolder::class, 'folder_id');
    }

    /**
     * Get the contractor associated with the document.
     */
    public function contractor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'contractor_id');
    }
} 