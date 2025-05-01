<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\DocumentFolder;

class DefaultDocumentFoldersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create default folders for all users
        $users = User::whereNotIn('role', ['admin'])->get();
        
        foreach ($users as $user) {
            $this->createDefaultFolders($user->id);
        }
        
        $this->command->info('Default document folders created for all users.');
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
}
