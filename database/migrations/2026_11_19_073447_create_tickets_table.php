<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_no', 20)->unique();
            
            $table->foreignId('asset_id')
                ->constrained('assets')
                ->cascadeOnDelete(); // Asset delete hole ticket o delete
            
            $table->text('issue');
            $table->string('reporter', 60)->default('Anonymous');
            $table->enum('priority', ['Low', 'Medium', 'High'])->default('Medium');
            $table->enum('status', ['Open', 'In Progress', 'Resolved'])->default('Open');
            
            // default 'Issue Report' set kora holo
            $table->enum('source', ['Maintenance', 'Issue Report'])->default('Issue Report');

            // Future features (Technician Assign & Resolution)
            $table->string('photo', 255)->nullable();
            $table->foreignId('assigned_to')->nullable()
                ->constrained('users')
                ->nullOnDelete();
            $table->text('resolution_note')->nullable();
            $table->decimal('cost', 10, 2)->nullable();
            $table->timestamp('resolved_at')->nullable();
            
            $table->timestamps();

            // Indexes
            $table->index('status');
            $table->index('source');
            $table->index('assigned_to');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};