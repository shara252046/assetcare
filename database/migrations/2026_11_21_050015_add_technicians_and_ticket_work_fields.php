<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Create Technicians Table
        Schema::create('technicians', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->timestamps();
        });

        // 2. Add fields to tickets table
        Schema::table('tickets', function (Blueprint $table) {
            // Foreign Key add kora holo (constrained)
            $table->foreignId('technician_id')->nullable()->constrained('technicians')->nullOnDelete();
            $table->text('technician_note')->nullable();
            
            $table->timestamp('resolved_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropForeign(['technician_id']);
            $table->dropColumn(['technician_id', 'technician_note', 'resolved_at']);
        });

        Schema::dropIfExists('technicians');
    }
};