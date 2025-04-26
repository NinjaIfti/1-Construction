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
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'project_types')) {
                $table->json('project_types')->nullable();
            }
            if (!Schema::hasColumn('users', 'services')) {
                $table->json('services')->nullable();
            }
            if (!Schema::hasColumn('users', 'project_volume')) {
                $table->string('project_volume')->nullable();
            }
            if (!Schema::hasColumn('users', 'hear_about')) {
                $table->string('hear_about')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'project_types',
                'services',
                'project_volume',
                'hear_about',
            ]);
        });
    }
}; 