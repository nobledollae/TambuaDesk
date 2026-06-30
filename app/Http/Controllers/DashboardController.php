<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // ============================
        // ADMIN DASHBOARD
        // ============================
        if ($user->role === 'admin') {

            return view('dashboard.index', [
                'openTickets'      => Ticket::where('status', 'Open')->count(),
                'assignedTickets'  => Ticket::where('status', 'Assigned')->count(),
                'resolvedTickets'  => Ticket::where('status', 'Resolved')->count(),
                'closedTickets'    => Ticket::where('status', 'Closed')->count(),

                'recentTickets' => Ticket::latest()->take(5)->get(),
            ]);
        }

        // ============================
        // TECHNICIAN DASHBOARD
        // ============================
        if ($user->role === 'technician') {

            return view('dashboard.index', [
                'openTickets' => Ticket::where('assigned_to', $user->id)
                    ->where('status', 'Open')
                    ->count(),

                'assignedTickets' => Ticket::where('assigned_to', $user->id)
                    ->where('status', 'Assigned')
                    ->count(),

                'resolvedTickets' => Ticket::where('assigned_to', $user->id)
                    ->where('status', 'Resolved')
                    ->count(),

                'closedTickets' => Ticket::where('assigned_to', $user->id)
                    ->where('status', 'Closed')
                    ->count(),

                'recentTickets' => Ticket::where('assigned_to', $user->id)
                    ->latest()
                    ->take(5)
                    ->get(),
            ]);
        }

        // ============================
        // DEFAULT (Customer or Other)
        // ============================
        return view('dashboard.index', [
            'openTickets' => 0,
            'assignedTickets' => 0,
            'resolvedTickets' => 0,
            'closedTickets' => 0,
            'recentTickets' => collect(),
        ]);
    }
}