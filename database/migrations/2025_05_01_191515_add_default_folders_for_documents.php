<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\DocumentFolder;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Create default folders for all existing users
        $users = User::whereNotIn('role', ['admin'])->get();
        
        foreach ($users as $user) {
            $this->createDefaultFolders($user->id);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Nothing to undo for this migration
    }
    
    /**
     * Create default folders for a user
     */
    private function createDefaultFolders($userId)
    {
        $defaultFolders = [
            'Permits',
            'Site Plans',
            'Licenses',
            'Credentials',
            'Contracts',
            'Invoices'
        ];
        
        foreach ($defaultFolders as $folderName) {
            // Check if folder already exists
            $existingFolder = DocumentFolder::where('user_id', $userId)
                ->where('name', $folderName)
                ->whereNull('parent_folder_id')
                ->first();
                
            if (!$existingFolder) {
                DocumentFolder::create([
                    'name' => $folderName,
                    'user_id' => $userId,
                    'parent_folder_id' => null
                ]);
            }
        }
    }
};
