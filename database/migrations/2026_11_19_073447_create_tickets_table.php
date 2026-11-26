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
            $table->string('ticket_no', 20)->nullable()->unique();
            
            $table->foreignId('asset_id')
                ->constrained('assets')
                ->cascadeOnDelete(); 
            
            $table->text('issue');
            $table->string('reporter', 60)->default('Anonymous');
            $table->enum('priority', ['Low', 'Medium', 'High'])->default('Medium');
            $table->enum('status', ['Open', 'In Progress', 'Resolved'])->default('Open');
            $table->enum('source', ['Maintenance', 'Issue Report'])->default('Issue Report');

            // Future features (Technician Assign & Resolution)
            $table->string('photo', 255)->nullable();
            $table->decimal('cost', 10, 2)->nullable(); // 🚨 Ei line ta ekhanei thakbe
            $table->timestamps();

            // Indexes
            $table->index('status');
            $table->index('source');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};