<?php

namespace Database\Seeders;

use App\Models\Asset;
use App\Models\Ticket;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    public function run(): void
    {
        $ac = Asset::where('code', 'AC-01')->first();
        $pc = Asset::where('code', 'PC-01')->first();

        if ($ac) {
            Ticket::createNumbered([
                'asset_id' => $ac->id,
                'issue' => 'AC is not cooling properly.',
                'reporter' => 'Rahim',
                'priority' => 'High',
                'status' => 'Open',
                'source' => 'Issue Report',
            ]);
        }

        if ($pc) {
            Ticket::createNumbered([
                'asset_id' => $pc->id,
                'issue' => 'Scheduled maintenance due.',
                'reporter' => 'System',
                'priority' => 'Medium',
                'status' => 'In Progress',
                'source' => 'Maintenance',
            ]);
        }
    }
}