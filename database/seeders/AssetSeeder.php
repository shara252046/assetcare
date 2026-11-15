<?php

namespace Database\Seeders;

use App\Models\Asset;
use Illuminate\Database\Seeder;

class AssetSeeder extends Seeder
{
    public function run(): void
    {
        foreach ([
            ['AC-01', 'AC - Room 101', 'AC', 7],
            ['PC-01', 'Dell Computer', 'Computer', 20],
            ['PR-01', 'HP Printer', 'Printer', -5],
            ['PR-02', 'HP Printer', 'Printer', 200],
            
        ] as [$code, $name, $cat, $days]) {
            Asset::updateOrCreate(
                ['code' => $code],
                [
                    'name' => $name,
                    'category' => $cat,
                    'warranty_end' => today()->addDays($days)->toDateString(),
                    'warranty_notified_at' => null,
                ]
            );
        }
    }
}