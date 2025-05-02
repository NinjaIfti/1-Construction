<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Check if we need to add a url column
        if (!Schema::hasColumn('notifications', 'url')) {
            DB::statement('ALTER TABLE notifications ADD COLUMN url VARCHAR(255) NULL');
        }
        
        // Check if we need to add a type column
        if (!Schema::hasColumn('notifications', 'type')) {
            DB::statement('ALTER TABLE notifications ADD COLUMN type VARCHAR(255) NOT NULL DEFAULT "info"');
        }
        
        // Make sure we have read column
        if (!Schema::hasColumn('notifications', 'read')) {
            DB::statement('ALTER TABLE notifications ADD COLUMN read BOOLEAN NOT NULL DEFAULT 0');
        }
        
        // Add necessary indexes
        try {
            DB::statement('CREATE INDEX notifications_user_id_index ON notifications (user_id)');
        } catch (\Exception $e) {
            // Index might already exist, ignore
        }
        
        try {
            DB::statement('CREATE INDEX notifications_read_index ON notifications (read)');
        } catch (\Exception $e) {
            // Index might already exist, ignore
        }
        
        try {
            DB::statement('CREATE INDEX notifications_created_at_index ON notifications (created_at)');
        } catch (\Exception $e) {
            // Index might already exist, ignore
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // We're not going to remove columns to avoid data loss
        // Just drop indexes if they exist
        try {
            DB::statement('DROP INDEX notifications_read_index ON notifications');
        } catch (\Exception $e) {
            // Index might not exist, ignore
        }
        
        try {
            DB::statement('DROP INDEX notifications_created_at_index ON notifications');
        } catch (\Exception $e) {
            // Index might not exist, ignore
        }
    }
};
