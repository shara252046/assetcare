<?php

namespace App\Console\Commands;

use App\Models\Asset;
use App\Models\Ticket;
use Illuminate\Console\Command;

//Asset-এর "পরের Service Due" তারিখ এসে গেলে সিস্টেম নিজে একটি Ticket তৈরি করে। কেউ Issue Report করে না, Admin-ও হাতে Ticket বানায় না। এই কাজ করে CheckMaintenance নামের একটি Command।
// ai pura file ta Maintenance Schedule + Auto Ticket er kaj korar time a make kora hoyeche


class CheckMaintenance extends Command
{
    protected $signature = 'maintenance:check';

    protected $description = 'Automatically creates a Maintenance Ticket when the Service Due Date has passed';

    public function handle(): int
    {
        $assets = Asset::whereNotNull('next_service_date')
            ->whereDate('next_service_date', '<=', today()->toDateString())
            ->get();

        $created = 0;

        foreach ($assets as $asset) {
            // same Asset-er agee Maintenance Ticket open thakle new Ticket hobe na.
            $exists = Ticket::where('asset_id', $asset->id)
                ->where('source', 'Maintenance')
                ->where('status', '!=', 'Resolved')
                ->exists();

            if ($exists) {
                continue;
            }

            Ticket::createNumbered([
                'asset_id' => $asset->id,
                'issue' => 'Scheduled maintenance due (' . $asset->next_service_date->format('d M Y') . ')',
                'reporter' => 'System',
                'priority' => 'Medium',
                'status' => 'Open',
                'source' => 'Maintenance',
            ]);
            $created++;
        }

        $this->info($created > 0 ? "$created  Maintenance Ticket's created" : 'No New Maintenance Ticket Needed');

        return self::SUCCESS;
    }
}