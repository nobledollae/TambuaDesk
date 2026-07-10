<?php

namespace App\Http\Controllers;

use App\Models\Ticket;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role == 'admin') {

            $query = Ticket::query();

        } elseif ($user->role == 'technician') {

            $query = Ticket::where('assigned_to', $user->id);

        } else {

            $query = Ticket::where('created_by', $user->id);

        }

        return view('dashboard.index', [

            'openTickets' => (clone $query)->where('status','Open')->count(),

            'assignedTickets' => (clone $query)->where('status','Assigned')->count(),

            'resolvedTickets' => (clone $query)->where('status','Resolved')->count(),

            'closedTickets' => (clone $query)->where('status','Closed')->count(),

            'recentTickets' => (clone $query)->latest()->take(5)->get(),

        ]);
    }
}