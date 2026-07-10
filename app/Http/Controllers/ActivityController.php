<?php

namespace App\Http\Controllers;

use App\Exports\ActivitiesExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * Display the activity logs.
     */
    public function index(Request $request)
    {
        $query = Activity::with('user')->latest();

        // Search by Ticket Number or Title
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('ticket_number', 'like', '%' . $request->search . '%')
                  ->orWhere('ticket_title', 'like', '%' . $request->search . '%');
            });
        }

        // Filter by User
        if ($request->filled('user')) {
            $query->where('user_id', $request->user);
        }

        // Filter by Action
        if ($request->filled('action')) {
            $query->where('action', 'like', '%' . $request->action . '%');
        }

        // Filter by Date
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $activities = $query->paginate(15)->withQueryString();

        return view('activities.index', compact('activities'));
    }

    public function exportExcel()
{
    return Excel::download(
        new ActivitiesExport,
        'activities.xlsx'
    );
}
}
