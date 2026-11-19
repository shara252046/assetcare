<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1 Admin & 1 Technician
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@assetcare.test',
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Technician User',
            'email' => 'tech@assetcare.test',
            'role' => 'technician',
        ]);

        // Call other seeders
        $this->call([
            AssetSeeder::class,
            TicketSeeder::class,
        ]);
    }
}