<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DocumentFolder extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'parent_folder_id',
    ];

    /**
     * Get the user that owns the folder.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the parent folder.
     */
    public function parentFolder(): BelongsTo
    {
        return $this->belongsTo(DocumentFolder::class, 'parent_folder_id');
    }

    /**
     * Get the subfolders in this folder.
     */
    public function subfolders(): HasMany
    {
        return $this->hasMany(DocumentFolder::class, 'parent_folder_id');
    }

    /**
     * Get the documents in this folder.
     */
    public function documents(): HasMany
    {
        return $this->hasMany(Document::class, 'folder_id');
    }

    /**
     * Get all descendant folders (recursive).
     */
    public function getAllSubfolders()
    {
        $subfolders = $this->subfolders;
        
        foreach ($this->subfolders as $subfolder) {
            $subfolders = $subfolders->merge($subfolder->getAllSubfolders());
        }
        
        return $subfolders;
    }
}