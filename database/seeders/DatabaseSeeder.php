<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Technician;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin User Code e set kora hoyeche
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'], // Email
            [
                'name' => 'Admin',
                'password' => Hash::make('admin123'), // Password
                'role' => 'admin',
            ]
        );

        // Dummy Technicians (Test korar jonno)
        Technician::updateOrCreate(
            ['name' => 'Rahim Uddin'],
            ['phone' => '01711111111', 'email' => 'rahim@gmail.com']
        );
        
        Technician::updateOrCreate(
            ['name' => 'Karim Ahmed'],
            ['phone' => '01822222222', 'email' => 'karim@gmail.com']
        );

        // Asset & Ticket Seeders call korun
        $this->call([
            AssetSeeder::class,
            TicketSeeder::class,
        ]);
    }
}