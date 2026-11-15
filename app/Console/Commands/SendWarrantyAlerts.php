<?php

namespace App\Console\Commands;

use App\Models\Asset;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendWarrantyAlerts extends Command
{
    protected $signature = 'warranty:alert';

    protected $description = 'Sends an email alert for assets whose warranty expires within the next 30 days';

    public function handle(): int
    {
        $assets = Asset::whereBetween('warranty_end', [
                today()->toDateString(),
                today()->addDays(30)->toDateString(),
            ])
            ->whereNull('warranty_notified_at')
            ->orderBy('warranty_end')
            ->get();

        if ($assets->isEmpty()) {
            $this->info('No new warranty alerts.');

            return self::SUCCESS;
        }

        $lines = $assets->map(fn (Asset $a) => "- {$a->name} ({$a->code}): "
            . $a->warranty_end->format('d M Y') . ' (' . $a->daysLeft() . ' days left)')->implode("\n");

        Mail::raw("Warranty expiring within 30 days:\n\n" . $lines, function ($message) {
            $message->to(config('assetcare.alert_email'))
                ->subject('AssetCare: Warranty expiring soon');
        });

        // Assets are marked only after the email is sent successfully, so the same asset never gets a second email
        Asset::whereIn('id', $assets->pluck('id'))->update(['warranty_notified_at' => today()->toDateString()]);

        $this->info($assets->count() . ' alert(s) sent.');

        return self::SUCCESS;
    }
}