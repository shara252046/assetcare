<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('assets', function (Blueprint $table) {
            $table->date('warranty_end')->nullable()->after('category');
            $table->date('warranty_notified_at')->nullable()->after('warranty_end');
        });
    }

    public function down(): void
    {
        Schema::table('assets', function (Blueprint $table) {
            $table->dropColumn(['warranty_end', 'warranty_notified_at']);
        });
    }
};
