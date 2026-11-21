<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Technician;
use Illuminate\Http\Request;

class TicketController extends Controller
{


//ticket system er jonno aigula function use kore hoyeche.
    public function show(Ticket $ticket)
    {
        return view('ticket', [
            'ticket' => $ticket->load(['asset', 'technician']),
            'technicians' => Technician::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Ticket $ticket)
    {
        // 'sometimes': ফর্মে ঘরটি না থাকলে (যেমন তালিকার Status ড্রপডাউন) সেই ঘর অপরিবর্তিত থাকে
        $data = $request->validate([
            'status' => 'required|in:Open,In Progress,Resolved',
            'technician_id' => 'sometimes|nullable|exists:technicians,id',
            'technician_note' => 'sometimes|nullable|string|max:1000',
            'cost' => 'sometimes|nullable|numeric|min:0|max:99999999',
        ]);

        $wasResolved = $ticket->status === 'Resolved';

        $ticket->fill($data);

        $becameResolved = $ticket->status === 'Resolved' && ! $wasResolved;

        if ($ticket->status === 'Resolved') {
            $ticket->resolved_at = $ticket->resolved_at ?? now();
        } else {
            $ticket->resolved_at = null;
        }

        $ticket->save();
// ai porjonto ticket system er kaj
        

        // Maintenance Ticket shesh hole Asset-er porer Due Date nije update hoi
        if ($becameResolved && $ticket->source === 'Maintenance' && $ticket->asset) {
            $ticket->asset->completeService();
        }

        return back()->with('ok', 'Status is Updated');
    }
}