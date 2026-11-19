<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('code', 20)->unique();
            $table->string('name', 60);
            $table->enum('category', ['AC', 'Computer', 'Printer', 'Vehicle']);
            
            // Future-proof fields (Asset Registry requirement)
            $table->string('brand', 50)->nullable();
            $table->string('serial_number', 80)->nullable();
            $table->string('location', 100)->nullable();
            $table->date('purchase_date')->nullable();
            $table->decimal('purchase_price', 12, 2)->nullable();
            $table->string('status', 20)->default('Active');
            
            // Warranty alert
            $table->date('warranty_end')->nullable();
            $table->date('warranty_notified_at')->nullable();
            
            // Maintenance Schedule
            $table->unsignedSmallInteger('service_interval_days')->nullable();
            $table->date('last_service_date')->nullable();
            $table->date('next_service_date')->nullable();
            
            $table->timestamps();

            // Indexes for dashboard performance
            $table->index('category');
            $table->index('next_service_date');
            $table->index('warranty_end');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};