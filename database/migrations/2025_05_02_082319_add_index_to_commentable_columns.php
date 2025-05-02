<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('comments', function (Blueprint $table) {
            // Add index for faster polymorphic relationship queries
            if (Schema::hasColumn('comments', 'commentable_id') && 
                Schema::hasColumn('comments', 'commentable_type')) {
                $table->index(['commentable_id', 'commentable_type'], 'comments_commentable_index');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropIndex('comments_commentable_index');
        });
    }
};
