<?php

namespace Database\Seeders;

use App\Models\Asset;
use Illuminate\Database\Seeder;

class AssetSeeder extends Seeder
{
    public function run(): void
    {
        foreach ([
            ['AC-01', 'AC - Room 101', 'AC'],
            ['PC-01', 'Dell Computer', 'Computer'],
            ['PR-01', 'HP Printer', 'Printer'],
        ] as [$code, $name, $cat]) {
            Asset::firstOrCreate(['code' => $code], ['name' => $name, 'category' => $cat]);
        }
    }
}