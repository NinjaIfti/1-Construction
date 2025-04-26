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
            if (!Schema::hasColumn('users', 'verification_status')) {
                $table->string('verification_status')->default('pending')->comment('pending, under_review, approved, rejected');
            }
            if (!Schema::hasColumn('users', 'license_number')) {
                $table->string('license_number')->nullable();
            }
            if (!Schema::hasColumn('users', 'contractor_license_file')) {
                $table->string('contractor_license_file')->nullable();
            }
            if (!Schema::hasColumn('users', 'drivers_license_file')) {
                $table->string('drivers_license_file')->nullable();
            }
            if (!Schema::hasColumn('users', 'insurance_certificate_file')) {
                $table->string('insurance_certificate_file')->nullable();
            }
            if (!Schema::hasColumn('users', 'admin_feedback')) {
                $table->text('admin_feedback')->nullable();
            }
            if (!Schema::hasColumn('users', 'documents_submitted_at')) {
                $table->timestamp('documents_submitted_at')->nullable();
            }
            if (!Schema::hasColumn('users', 'verified_at')) {
                $table->timestamp('verified_at')->nullable();
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
                'verification_status',
                'license_number',
                'contractor_license_file',
                'drivers_license_file',
                'insurance_certificate_file',
                'admin_feedback',
                'documents_submitted_at',
                'verified_at',
            ]);
        });
    }
}; 