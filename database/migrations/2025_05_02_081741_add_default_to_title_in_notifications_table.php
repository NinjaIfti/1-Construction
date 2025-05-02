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
        Schema::table('notifications', function (Blueprint $table) {
            // First check if the title column exists
            if (Schema::hasColumn('notifications', 'title')) {
                $table->string('title')->default('Notification')->change();
            } else {
                // If it doesn't exist (perhaps the error is about a missing column), add it
                $table->string('title')->default('Notification')->after('id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('notifications', function (Blueprint $table) {
            // Only make changes if the column exists
            if (Schema::hasColumn('notifications', 'title')) {
                $table->string('title')->nullable(false)->default(null)->change();
            }
        });
    }
};
