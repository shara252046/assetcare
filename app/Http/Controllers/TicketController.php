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

        $ticket->update(['status' => $data['status']]);

        return back()->with('ok', 'Status is updated');
    }
}