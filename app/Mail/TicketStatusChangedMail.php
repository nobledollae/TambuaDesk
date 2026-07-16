<?php

namespace App\Mail;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TicketStatusChangedMail extends Mailable
{
    use Queueable, SerializesModels;

    public Ticket $ticket;
    public string $oldStatus;
    public string $newStatus;

    public function __construct(Ticket $ticket, string $oldStatus, string $newStatus)
    {
        $this->ticket = $ticket;
        $this->oldStatus = $oldStatus;
        $this->newStatus = $newStatus;
    }

    public function build()
    {
        return $this
            ->subject('🔄 Ticket Status Updated - '.$this->ticket->ticket_number)
            ->view('emails.ticket-status');
    }
}