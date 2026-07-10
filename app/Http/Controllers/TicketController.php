<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\TicketAssignedNotification;

class TicketController extends Controller
{
    /**
     * Display all tickets.
     */
   public function index(Request $request)
{
    $user = auth()->user();

    $query = Ticket::with(['technician', 'creator']);

    /*
    |--------------------------------------------------------------------------
    | Role-based access
    |--------------------------------------------------------------------------
    */

    if ($user->role === 'technician') {

        $query->where('assigned_to', $user->id);

    } elseif ($user->role === 'employee') {

        $query->where('created_by', $user->id);

    }

    /*
    |--------------------------------------------------------------------------
    | Search
    |--------------------------------------------------------------------------
    */

    if ($request->filled('search')) {

        $search = trim($request->search);

        $query->where(function ($q) use ($search) {

            $q->where('ticket_number', 'LIKE', "%{$search}%")
              ->orWhere('title', 'LIKE', "%{$search}%")
              ->orWhere('description', 'LIKE', "%{$search}%");

        });

    }

    /*
    |--------------------------------------------------------------------------
    | Status Filter
    |--------------------------------------------------------------------------
    */

    if ($request->filled('status')) {

        $query->where('status', $request->status);

    }

    /*
    |--------------------------------------------------------------------------
    | Priority Filter
    |--------------------------------------------------------------------------
    */

    if ($request->filled('priority')) {

        $query->where('priority', $request->priority);

    }

    /*
    |--------------------------------------------------------------------------
    | Technician Filter
    |--------------------------------------------------------------------------
    */

    if (

        $user->role === 'admin' &&
        $request->filled('assigned_to')

    ) {

        $query->where('assigned_to', $request->assigned_to);

    }

    $tickets = $query
        ->latest()
        ->paginate(10)
        ->withQueryString();

    $technicians = User::where('role', 'technician')
        ->orderBy('name')
        ->get();

    return view('tickets.index', compact(
        'tickets',
        'technicians'
    ));
}
    /**
     * Show create form.
     */
    public function create()
    {
        return view('tickets.create');
    }

    /**
     * Store ticket.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'priority' => 'required',
        ]);

        $ticket = Ticket::create([
            'ticket_number' => 'TKT-' . time(),
            'title'         => $request->title,
            'description'   => $request->description,
            'priority'      => $request->priority,
            'status'        => 'Open',
            'created_by'    => Auth::id(),
        ]);

        return redirect()
            ->route('tickets.create')
            ->with('success', 'Ticket created successfully!');
    }

    /**
     * Display ticket.
     */
    public function show(Ticket $ticket)
    {
        $user = auth()->user();

        if ($user->role != 'admin') {

            if (
                $user->role == 'technician' &&
                $ticket->assigned_to != $user->id
            ) {
                abort(403);
            }

            if (
                $user->role == 'employee' &&
                $ticket->created_by != $user->id
            ) {
                abort(403);
            }
        }

        $ticket->load(
    'comments.user',
    'technician',
    'creator'
);

$activities = Activity::with('user')
    ->where('ticket_number', $ticket->ticket_number)
    ->latest()
    ->get();

       return view('tickets.show', compact(
    'ticket',
    'activities'
));
    }

    /**
     * Show edit form.
     */
    public function edit(Ticket $ticket)
    {
        $user = auth()->user();

        if ($user->role == 'employee') {
            abort(403);
        }

        if (
            $user->role == 'technician' &&
            $ticket->assigned_to != $user->id
        ) {
            abort(403);
        }

        $technicians = User::where('role', 'technician')->get();

        return view('tickets.edit', compact(
            'ticket',
            'technicians'
        ));
    }

    /**
     * Update ticket.
     */
    public function update(Request $request, Ticket $ticket)
    {
        $user = auth()->user();

        if ($user->role == 'employee') {
            abort(403);
        }

        if (
            $user->role == 'technician' &&
            $ticket->assigned_to != $user->id
        ) {
            abort(403);
        }

        $request->validate([
            'title'       => 'required|max:255',
            'description' => 'required',
            'priority'    => 'required',
            'status'      => 'required',
            'assigned_to' => 'nullable|exists:users,id',
        ]);

        $data = [
            'title'       => $request->title,
            'description' => $request->description,
            'priority'    => $request->priority,
            'status'      => $request->status,
        ];

        if ($user->role == 'admin') {
            $data['assigned_to'] = $request->assigned_to;
        }

        $ticket->update($data);

    
        if ($request->filled('assigned_to')) {

            $technician = User::find($request->assigned_to);

            if ($technician) {

                $technician->notify(
                    new TicketAssignedNotification($ticket)
                );

            }

        }

        return redirect()
            ->route('tickets.index')
            ->with('success', 'Ticket updated successfully.');
    }

    /**
     * Delete ticket.
     */
    public function destroy(Ticket $ticket)
    {
        if (auth()->user()->role != 'admin') {
            abort(403);
        }


        $ticket->delete();

        return redirect()
            ->route('tickets.index')
            ->with('success', 'Ticket deleted successfully.');
    }
}