<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class MaintenanceController extends Controller
{
    public function index()
    {
        return view('maintenance', [
            'assets' => Asset::orderBy('code')->get(),
        ]);
    }

    public function update(Request $request, Asset $asset)
    {
        $data = $request->validate([
            'service_interval_days' => 'nullable|integer|min:1|max:3650',
            'next_service_date' => 'nullable|date',
        ]);

        // "Interval" dawa ache but porer "Due Date" nei: nije hishab kore boshabe
        if (! empty($data['service_interval_days']) && empty($data['next_service_date'])) {
            $base = $asset->last_service_date ?? today();
            $data['next_service_date'] = $base->copy()->addDays((int) $data['service_interval_days'])->toDateString();
        }

        $asset->update($data);

        return back()->with('ok', "{$asset->code}- Schedule is Updated");
    }

    // Daily Job-er kaj hat a chaliye dekhar jonno
        public function run()
    {
        // Command call baad diye direct logic run korchi
        $assets = \App\Models\Asset::whereNotNull('next_service_date')
            ->whereDate('next_service_date', '<=', today()->toDateString())
            ->get();

        $created = 0;

        foreach ($assets as $asset) {
            $exists = \App\Models\Ticket::where('asset_id', $asset->id)
                ->where('source', 'Maintenance')
                ->where('status', '!=', 'Resolved')
                ->exists();

            if ($exists) {
                continue;
            }

            \App\Models\Ticket::createNumbered([
                'asset_id' => $asset->id,
                'issue' => 'Scheduled maintenance due (' . $asset->next_service_date->format('d M Y') . ')',
                'reporter' => 'System',
                'priority' => 'Medium',
                'status' => 'Open',
                'source' => 'Maintenance',
            ]);
            $created++;
        }

        if ($created > 0) {
            return back()->with('ok', "$created টি Maintenance Ticket তৈরি হয়েছে!");
        }

        return back()->with('ok', 'কোনো নতুন Maintenance Ticket দরকার নেই।');
    }
}