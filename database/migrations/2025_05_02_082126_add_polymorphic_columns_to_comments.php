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
        Schema::table('comments', function (Blueprint $table) {
            // Add the polymorphic relationship columns
            $table->unsignedBigInteger('commentable_id')->nullable();
            $table->string('commentable_type')->nullable();
            
            // Create index for faster queries
            $table->index(['commentable_id', 'commentable_type']);
        });
        
        // Transfer data if the old permit_id column exists
        if (Schema::hasColumn('comments', 'permit_id')) {
            DB::statement('UPDATE comments SET commentable_id = permit_id, commentable_type = "App\\\\Models\\\\Permit" WHERE permit_id IS NOT NULL');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('comments', function (Blueprint $table) {
            // Drop the polymorphic columns
            $table->dropIndex(['commentable_id', 'commentable_type']);
            $table->dropColumn('commentable_type');
            $table->dropColumn('commentable_id');
        });
    }
};
