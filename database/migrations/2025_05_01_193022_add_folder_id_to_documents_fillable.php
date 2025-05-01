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
        // Check if folder_id exists, if not add it
        if (!Schema::hasColumn('documents', 'folder_id')) {
            Schema::table('documents', function (Blueprint $table) {
                $table->foreignId('folder_id')->nullable()->after('permit_id')->constrained('document_folders')->onDelete('set null');
            });
        }
        
        // Check if user_id exists, if not add it
        if (!Schema::hasColumn('documents', 'user_id')) {
            Schema::table('documents', function (Blueprint $table) {
                $table->foreignId('user_id')->nullable()->after('folder_id')->constrained('users')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // We don't want to remove these columns in down migration
    }
};
