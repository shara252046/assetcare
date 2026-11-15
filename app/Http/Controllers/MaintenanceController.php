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
        Artisan::call('maintenance:check');

        return back()->with('ok', trim(Artisan::output()));
    }
}