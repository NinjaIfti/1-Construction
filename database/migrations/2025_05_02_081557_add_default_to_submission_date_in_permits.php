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
        Schema::table('permits', function (Blueprint $table) {
            // First make the column nullable to fix any existing records
            $table->timestamp('submission_date')->nullable()->change();
        });
        
        // Set default value for submission_date to current timestamp
        DB::statement('ALTER TABLE permits MODIFY submission_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('permits', function (Blueprint $table) {
            $table->timestamp('submission_date')->nullable(false)->change();
        });
    }
};
