<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        //asets table a new column add
        Schema::table('assets', function (Blueprint $table) {
            $table->unsignedInteger('service_interval_days')->nullable();
            $table->date('last_service_date')->nullable();
            $table->date('next_service_date')->nullable();
        });

        
        //tickets table a source column add
        Schema::table('tickets', function (Blueprint $table) {
            $table->string('source')->default('QR');
        });
    }

    public function down(): void
    {
        //rollback korle column gula muche jabe
        Schema::table('assets', function (Blueprint $table) {
            $table->dropColumn(['service_interval_days', 'last_service_date', 'next_service_date']);
        });

        Schema::table('tickets', function (Blueprint $table) {
            $table->dropColumn('source');
        });
    }
};