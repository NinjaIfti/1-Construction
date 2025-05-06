<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            if (!Schema::hasColumn('projects', 'budget')) {
                $table->decimal('budget', 10, 2)->nullable()->after('end_date');
            }
            if (!Schema::hasColumn('projects', 'status')) {
                $table->enum('status', ['pending', 'in_progress', 'completed'])->default('pending')->after('budget');
            }
            if (!Schema::hasColumn('projects', 'contractor_id')) {
                $table->foreignId('contractor_id')->nullable()->after('description')->constrained('users')->onDelete('cascade');
            }
        });
    }

    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            if (Schema::hasColumn('projects', 'budget')) {
                $table->dropColumn('budget');
            }
            if (Schema::hasColumn('projects', 'status')) {
                $table->dropColumn('status');
            }
            if (Schema::hasColumn('projects', 'contractor_id')) {
                $table->dropForeign(['contractor_id']);
                $table->dropColumn('contractor_id');
            }
        });
    }
}; 