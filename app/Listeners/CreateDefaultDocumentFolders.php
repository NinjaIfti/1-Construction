<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;
use App\Models\DocumentFolder;

class CreateDefaultDocumentFolders
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Registered $event): void
    {
        $user = $event->user;
        
        // Skip for admin users
        if ($user->role === 'admin') {
            return;
        }
        
        // Default document folders
        $defaultFolders = [
            'Permits',
            'Site Plans',
            'Licenses',
            'Credentials',
            'Contracts',
            'Invoices'
        ];
        
        foreach ($defaultFolders as $folderName) {
            DocumentFolder::create([
                'name' => $folderName,
                'user_id' => $user->id,
                'parent_folder_id' => null
            ]);
        }
    }
}
