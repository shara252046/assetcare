<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function update(Request $request, Ticket $ticket)
    {
        $data = $request->validate([
            'status' => 'required|in:Open,In Progress,Resolved',
        ]);

        $becameResolved = $data['status'] === 'Resolved' && $ticket->status !== 'Resolved';

        $ticket->update($data);

        // Maintenance Ticket shesh hole Asset-er porer Due Date nije update hoi
        if ($becameResolved && $ticket->source === 'Maintenance' && $ticket->asset) {
            $ticket->asset->completeService();
        }

        return back()->with('ok', 'Status is Updated');
    }
}