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
        // First, get the current enum values to preserve them in the new column
        $statusValues = DB::select("SHOW COLUMNS FROM projects WHERE Field = 'status'");
        $type = $statusValues[0]->Type;
        
        // Log the current type for debugging
        \Log::info('Current status column type: ' . $type);
        
        // Change the column type to string
        Schema::table('projects', function (Blueprint $table) {
            $table->string('status')->default('pending')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->enum('status', ['pending', 'in_progress', 'completed'])->default('pending')->change();
        });
    }
};
