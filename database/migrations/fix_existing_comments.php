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
        // Update existing comments to use the polymorphic relationship
        DB::statement('UPDATE comments SET commentable_id = permit_id, commentable_type = "App\\\\Models\\\\Permit" WHERE permit_id IS NOT NULL AND commentable_id IS NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No rollback needed for this fix
    }
}; 