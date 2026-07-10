<?php

namespace App\Notifications;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class TicketAssignedNotification extends Notification
{
    use Queueable;

    public $ticket;

    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [

            'title' => 'New Ticket Assigned',

            'message' => 'Ticket '.$this->ticket->ticket_number.' has been assigned to you.',

            'ticket_id' => $this->ticket->id,

        ];
    }
}