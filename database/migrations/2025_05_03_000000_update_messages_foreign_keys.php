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
        Schema::table('messages', function (Blueprint $table) {
            // Drop existing foreign keys
            $table->dropForeign(['sender_id']);
            $table->dropForeign(['recipient_id']);
            $table->dropForeign(['contractor_id']);
            $table->dropForeign(['parent_id']);

            // Add new foreign keys with cascade delete
            $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('recipient_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('contractor_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('parent_id')->references('id')->on('messages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            // Drop cascade foreign keys
            $table->dropForeign(['sender_id']);
            $table->dropForeign(['recipient_id']);
            $table->dropForeign(['contractor_id']);
            $table->dropForeign(['parent_id']);

            // Add back original foreign keys
            $table->foreign('sender_id')->references('id')->on('users');
            $table->foreign('recipient_id')->references('id')->on('users');
            $table->foreign('contractor_id')->references('id')->on('users');
            $table->foreign('parent_id')->references('id')->on('messages');
        });
    }
}; 