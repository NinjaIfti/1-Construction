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
        Schema::table('invoices', function (Blueprint $table) {
            // Drop the foreign key constraint if it exists
            if (Schema::hasColumn('invoices', 'user_id')) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            }

            // Add the new contractor_id column
            $table->foreignId('contractor_id')->after('id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            // Drop the contractor_id foreign key and column
            $table->dropForeign(['contractor_id']);
            $table->dropColumn('contractor_id');

            // Add back the user_id column
            $table->foreignId('user_id')->after('id')->constrained()->onDelete('cascade');
        });
    }
}; 