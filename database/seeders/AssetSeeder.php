<?php

namespace Database\Seeders;

use App\Models\Asset;
use Illuminate\Database\Seeder;

class AssetSeeder extends Seeder
{
    public function run(): void
    {
        // interval days & next_service_date add kora holo
        foreach ([
            ['AC-01', 'AC - Room 101', 'AC', 7, 90, 30],
            ['PC-01', 'Dell Computer', 'Computer', 20, 180, 10],
            ['PR-01', 'HP Printer', 'Printer', -5, 120, 15], // Expired warranty
            ['PR-02', 'HP Printer', 'Printer', 200, 120, 5], // Expiring next_service
            ['VH-01', 'Toyota Corolla', 'Vehicle', 50, 365, 60],
        ] as [$code, $name, $cat, $days, $interval, $nextServiceDays]) {
            Asset::updateOrCreate(
                ['code' => $code],
                [
                    'name' => $name,
                    'category' => $cat,
                    'warranty_end' => today()->addDays($days)->toDateString(),
                    'warranty_notified_at' => null,
                    'service_interval_days' => $interval,
                    'next_service_date' => today()->addDays($nextServiceDays)->toDateString(),
                ]
            );
        }
    }
}