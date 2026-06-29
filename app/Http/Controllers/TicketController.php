<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
{
    $tickets = \App\Models\Ticket::latest()->paginate(10);

    return view('tickets.index', compact('tickets'));
}
    public function create()
{
    return view('tickets.create');
}
public function show(Ticket $ticket)
{
    return view('tickets.show', compact('ticket'));
}
   public function store(Request $request)
{
    $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'priority' => 'required'
    ]);

    Ticket::create([
        'ticket_number' => 'TKT-' . time(),
        'title' => $request->title,
        'description' => $request->description,
        'priority' => $request->priority,
        'status' => 'Open',
        'created_by' => 1
    ]);

    return redirect('/tickets/create')->with('success', 'Ticket created successfully!');
}
    public function edit(Ticket $ticket)
{
    return view('tickets.edit', compact('ticket'));
}
    public function update(Request $request, Ticket $ticket)
{
    $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'priority' => 'required',
        'status' => 'required',
    ]);

    $ticket->update([
        'title' => $request->title,
        'description' => $request->description,
        'priority' => $request->priority,
        'status' => $request->status,
    ]);

    return redirect()
        ->route('tickets.index')
        ->with('success', 'Ticket updated successfully.');
}
    public function destroy(Ticket $ticket)
{
    $ticket->delete();

    return redirect()
        ->route('tickets.index')
        ->with('success', 'Ticket deleted successfully.');
}
}
