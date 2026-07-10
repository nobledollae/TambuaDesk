<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $search = trim($request->search);

        if (!$search) {
            return redirect()->back();
        }

        $tickets = Ticket::with(['technician', 'creator'])
            ->where('ticket_number', 'like', "%{$search}%")
            ->orWhere('title', 'like', "%{$search}%")
            ->orWhere('description', 'like', "%{$search}%")
            ->latest()
            ->take(10)
            ->get();

        $users = User::where('name', 'like', "%{$search}%")
            ->orWhere('email', 'like', "%{$search}%")
            ->take(10)
            ->get();

        $activities = Activity::with('user')
            ->where('ticket_number', 'like', "%{$search}%")
            ->orWhere('ticket_title', 'like', "%{$search}%")
            ->orWhere('action', 'like', "%{$search}%")
            ->latest()
            ->take(10)
            ->get();

        return view('search.index', compact(
            'search',
            'tickets',
            'users',
            'activities'
        ));
    }
}