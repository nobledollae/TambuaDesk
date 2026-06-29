<?php

namespace App\Http\Controllers;

use App\Models\Ticket;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index', [
            'openTickets' => Ticket::where('status', 'Open')->count(),
            'assignedTickets' => Ticket::where('status', 'Assigned')->count(),
            'resolvedTickets' => Ticket::where('status', 'Resolved')->count(),
            'closedTickets' => Ticket::where('status', 'Closed')->count(),

            'recentTickets' => Ticket::latest()->take(5)->get(),
        ]);
    }
}