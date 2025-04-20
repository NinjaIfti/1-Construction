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
        Schema::create('permits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->onDelete('cascade');
            $table->string('permit_number')->unique();
            $table->string('type'); // Electrical, Plumbing, HVAC, etc.
            $table->enum('status', ['Pending', 'In Review', 'Approved', 'Rejected']);
            $table->date('submission_date');
            $table->date('approval_date')->nullable();
            $table->date('expiration_date')->nullable();
            $table->text('description')->nullable();
            $table->decimal('fee_amount', 10, 2)->nullable();
            $table->boolean('fee_paid')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permits');
    }
};
