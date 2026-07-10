<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;

class ReportController extends Controller
{
    public function index()
    {
        // Ticket Status Statistics
        $totalTickets = Ticket::count();
        $openTickets = Ticket::where('status', 'Open')->count();
        $assignedTickets = Ticket::where('status', 'Assigned')->count();
        $inProgressTickets = Ticket::where('status', 'In Progress')->count();
        $resolvedTickets = Ticket::where('status', 'Resolved')->count();
        $closedTickets = Ticket::where('status', 'Closed')->count();

        // Priority Statistics
        $lowPriority = Ticket::where('priority', 'Low')->count();
        $mediumPriority = Ticket::where('priority', 'Medium')->count();
        $highPriority = Ticket::where('priority', 'High')->count();
        $criticalPriority = Ticket::where('priority', 'Critical')->count();

        // Technician Workload
        $technicians = User::where('role', 'technician')
            ->withCount('assignedTickets')
            ->get();

        // Monthly Ticket Trend
        $monthlyTickets = Ticket::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return view('reports.index', compact(
            'totalTickets',
            'openTickets',
            'assignedTickets',
            'inProgressTickets',
            'resolvedTickets',
            'closedTickets',
            'lowPriority',
            'mediumPriority',
            'highPriority',
            'criticalPriority',
            'technicians',
            'monthlyTickets'
        ));
    }
}