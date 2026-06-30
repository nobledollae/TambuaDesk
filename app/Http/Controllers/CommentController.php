<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Comment;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CommentController extends Controller
{
    public function store(Request $request, Ticket $ticket)
    {
        $request->validate([
            'comment' => 'required|string'
        ]);

        Comment::create([
            'ticket_id' => $ticket->id,
            'user_id' => Auth::id(),
            'comment' => $request->comment
        ]);

        Activity::create([
    'ticket_id' => $ticket->id,
    'user_id' => Auth::id(),
    'action' => 'added a comment'
]);

        return back()->with('success', 'Comment added successfully.');
    }
}