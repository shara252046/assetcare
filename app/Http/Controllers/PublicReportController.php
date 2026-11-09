<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PublicReportController extends Controller
{
    public function show(string $code)
    {
        $asset = Asset::where('code', $code)->firstOrFail();

        return view('report', ['asset' => $asset]);
    }

    public function store(Request $request, string $code)
    {
        $asset = Asset::where('code', $code)->firstOrFail();

        $data = $request->validate([
            'reporter' => 'nullable|string|max:60',
            'issue' => 'required|string|min:3|max:300',
            'priority' => 'required|in:Low,Medium,High',
        ]);

        $ticket = DB::transaction(function () use ($asset, $data) {
            $t = Ticket::create([
                'asset_id' => $asset->id,
                'issue' => $data['issue'],
                'reporter' => $data['reporter'] ?: 'Anonymous',
                'priority' => $data['priority'],
                'status' => 'Open',
            ]);
            $t->update(['ticket_no' => 'T-' . (100 + $t->id)]);

            return $t;
        });

        return back()->with('ok', 'Thanks! Ticket ' . $ticket->ticket_no . ' তৈরি হয়েছে।');
    }
}