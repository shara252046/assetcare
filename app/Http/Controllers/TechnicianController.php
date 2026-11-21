<?php

namespace App\Http\Controllers;

use App\Models\Technician;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TechnicianController extends Controller
{
    public function index()
    {
        return view('technicians', [
            'technicians' => Technician::withCount([
                'tickets as open_count' => fn ($q) => $q->where('status', '!=', 'Resolved'),
            ])->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:60',
            'phone' => 'nullable|string|max:30',
            'email' => 'nullable|email|max:100',
        ]);

        Technician::create($data);

        return back()->with('ok', 'Technician যোগ হয়েছে।');
    }

    public function destroy(Technician $technician)
    {
        // মুছলে তার Ticket-গুলো Unassigned হয়ে যায়, Ticket মুছে যায় না
        Ticket::where('technician_id', $technician->id)->update(['technician_id' => null]);
        $technician->delete();

        return back()->with('ok', 'Technician মুছে ফেলা হয়েছে।');
    }
}



// ai full TechnicianController file ti jokhn ticket system feature niye kaj kora hoyeche tkhn create kora hoyeche.