<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Comment;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\TicketCommentMail;


class CommentController extends Controller
{
    public function store(Request $request, Ticket $ticket)
    {
        $request->validate([
            'comment' => 'required|string'
        ]);

        $comment = Comment::create([
    'ticket_id' => $ticket->id,
    'user_id' => Auth::id(),
    'comment' => $request->comment,
]);

       Activity::create([
    'ticket_number' => $ticket->ticket_number,
    'ticket_title'  => $ticket->title,
    'user_id'       => Auth::id(),
    'action'        => 'added a comment',
]);

// Notify the ticket creator
if ($ticket->creator && $ticket->creator->id != Auth::id()) {

    Mail::to($ticket->creator->email)
        ->send(new TicketCommentMail($comment));

}

// Notify the assigned technician
if (
    $ticket->technician &&
    $ticket->technician->id != Auth::id()
) {

    Mail::to($ticket->technician->email)
        ->send(new TicketCommentMail($comment));

}
        return back()->with('success', 'Comment added successfully.');
    }
}