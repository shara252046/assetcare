<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Ticket;
use Illuminate\Http\Request;

class PublicReportController extends Controller
{
    public function show(string $code)
    {
        $asset = Asset::where('code', $code)->firstOrFail();
        return view('report', ['asset' => $asset]);
    }




    //for photo upload
        public function store(Request $request, string $code)
    {
        $asset = Asset::where('code', $code)->firstOrFail();

        $data = $request->validate([
            'reporter' => 'nullable|string|max:60',
            'issue' => 'required|string|min:3|max:300',
            'priority' => 'required|in:Low,Medium,High',
            'photo' => 'nullable|image|max:2048', // 🚨 FIX 5: Photo validation
        ]);

        $photoPath = $request->hasFile('photo')
            ? $request->file('photo')->store('tickets', 'public')
            : null;

        $ticket = Ticket::createNumbered([
            'asset_id' => $asset->id,
            'issue' => $data['issue'],
            'reporter' => $data['reporter'] ?: 'Anonymous',
            'priority' => $data['priority'],
            'status' => 'Open',
            'source' => 'Issue Report',
            'photo' => $photoPath, // 🚨 FIX 5: Save photo path
        ]);

        return back()->with('ok', 'Thanks! Ticket ' . $ticket->ticket_no . ' তৈরি হয়েছে।');
    }
}