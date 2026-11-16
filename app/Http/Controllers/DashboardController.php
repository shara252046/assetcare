<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Ticket;

class DashboardController extends Controller
{
    public function index()
    {
        $today = today()->toDateString();
        $in30 = today()->addDays(30)->toDateString();

        // ৩০ দিনের মধ্যে Warranty শেষ হবে এমন Asset-এর Query (একাধিক জায়গায় লাগে)
        $expiring = fn () => Asset::whereDate('warranty_end', '>=', $today)
            ->whereDate('warranty_end', '<=', $in30);

        // ৪টি Summary Card-এর সংখ্যা
        $stats = [
            'total' => Asset::count(),
            'open' => Ticket::where('status', '!=', 'Resolved')->count(),
            'overdue' => Asset::whereNotNull('next_service_date')
                ->whereDate('next_service_date', '<', $today)->count(),
            'warranty' => $expiring()->count(),
        ];

        return view('dashboard', [
            'stats' => $stats,
            'upcoming' => Asset::whereNotNull('next_service_date')
                ->orderBy('next_service_date')->limit(5)->get(),
            'expiring' => $expiring()->orderBy('warranty_end')->limit(5)->get(),
            'recent' => Ticket::with('asset')->latest()->limit(5)->get(),
            'byCategory' => Asset::selectRaw('category, count(*) as n')
                ->groupBy('category')->orderBy('category')->pluck('n', 'category'),
            'ticketCounts' => Ticket::selectRaw('status, count(*) as n')
                ->groupBy('status')->pluck('n', 'status'),
        ]);
    }
}