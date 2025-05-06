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
            if (!Schema::hasColumn('permits', 'approved_date')) {
                $table->date('approved_date')->nullable()->after('approval_date');
            }
        });

        // Copy data from approval_date to approved_date
        DB::statement('UPDATE permits SET approved_date = approval_date WHERE approval_date IS NOT NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('permits', function (Blueprint $table) {
            if (Schema::hasColumn('permits', 'approved_date')) {
                $table->dropColumn('approved_date');
            }
        });
    }
}; 