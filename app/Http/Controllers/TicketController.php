<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Activity;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  public function index()
{
    $tickets = Ticket::with('technician')
                ->latest()
                ->paginate(10);

    return view('tickets.index', compact('tickets'));
}
    public function create()
{
    return view('tickets.create');
}
public function show(Ticket $ticket)
{
    $ticket->load(
        'comments.user',
        'technician',
        'creator',
        'activities.user'
    );

    return view('tickets.show', compact('ticket'));
}
   public function store(Request $request)
{
    $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'priority' => 'required'
    ]);

   $ticket = Ticket::create([
    
        'ticket_number' => 'TKT-' . time(),
        'title' => $request->title,
        'description' => $request->description,
        'priority' => $request->priority,
        'status' => 'Open',
        'created_by' => auth()->id()
    ]);

    Activity::create([
    'ticket_id' => $ticket->id,
    'user_id' => Auth::id(),
    'action' => 'created the ticket'
]);

Activity::create([
    'ticket_id' => $ticket->id,
    'user_id' => Auth::id(),
    'action' => 'updated the ticket'
]);

    return redirect('/tickets/create')->with('success', 'Ticket created successfully!');
}
  public function edit(Ticket $ticket)
{
    $technicians = User::where('role', 'technician')->get();

    return view('tickets.edit', compact('ticket', 'technicians'));
}
    public function update(Request $request, Ticket $ticket)
{
    $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'priority' => 'required',
        'status' => 'required',
        'assigned_to' => 'nullable|exists:users,id',
    ]);

    $ticket->update([
        'title' => $request->title,
        'description' => $request->description,
        'priority' => $request->priority,
        'status' => $request->status,
        'assigned_to' => $request->assigned_to,
    ]);

    return redirect()
        ->route('tickets.index')
        ->with('success', 'Ticket updated successfully.');
}
    public function destroy(Ticket $ticket)
{

Activity::create([
    'ticket_id' => $ticket->id,
    'user_id' => Auth::id(),
    'action' => 'deleted the ticket'
]);
    $ticket->delete();

    return redirect()
        ->route('tickets.index')
        ->with('success', 'Ticket deleted successfully.');
}
}
