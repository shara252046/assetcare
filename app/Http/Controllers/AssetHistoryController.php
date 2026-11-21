<?php

namespace App\Http\Controllers;

use App\Models\Asset;

class AssetHistoryController extends Controller
{
    public function show(Asset $asset)
    {
        // শেষ হওয়া কাজ: নতুন আগে (Resolved-এর সময় না থাকলে সর্বশেষ আপডেটের সময় ধরা হয়)
        $history = $asset->tickets()
            ->with('technician')
            ->where('status', 'Resolved')
            ->orderByRaw('COALESCE(resolved_at, updated_at) DESC')
            ->get();

        // এখনো চলমান Ticket
        $open = $asset->tickets()
            ->with('technician')
            ->where('status', '!=', 'Resolved')
            ->latest()
            ->get();

        return view('asset-history', [
            'asset' => $asset,
            'history' => $history,
            'open' => $open,
            'totalCost' => $history->sum(fn ($t) => (float) $t->cost),
        ]);
    }
}