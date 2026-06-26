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
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    return view('tickets.create');
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
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ticket $ticket)
    {
        //
    }
}
