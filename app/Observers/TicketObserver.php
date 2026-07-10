<?php

namespace App\Observers;

use App\Models\Activity;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TicketObserver
{
    /**
     * Log ticket creation.
     */
    public function created(Ticket $ticket): void
    {
        Activity::create([
            'ticket_number' => $ticket->ticket_number,
            'ticket_title'  => $ticket->title,
            'user_id'       => Auth::id(),
            'action'        => 'created the ticket',
        ]);
    }

    /**
     * Log ticket updates.
     */
    public function updated(Ticket $ticket): void
    {
        $changes = $ticket->getChanges();

        unset($changes['updated_at']);

        if (empty($changes)) {
            return;
        }

        foreach ($changes as $field => $newValue) {

            $oldValue = $ticket->getOriginal($field);

            switch ($field) {

                case 'status':
                    $action = "changed status from '{$oldValue}' to '{$newValue}'";
                    break;

                case 'priority':
                    $action = "changed priority from '{$oldValue}' to '{$newValue}'";
                    break;

                case 'assigned_to':

                    $oldTech = User::find($oldValue);
                    $newTech = User::find($newValue);

                    $action = "assigned ticket from '" .
                        ($oldTech?->name ?? 'Unassigned') .
                        "' to '" .
                        ($newTech?->name ?? 'Unassigned') . "'";

                    break;

                case 'title':
                    $action = 'changed the title';
                    break;

                case 'description':
                    $action = 'updated the description';
                    break;

                default:
                    continue 2;
            }

            Activity::create([
                'ticket_number' => $ticket->ticket_number,
                'ticket_title'  => $ticket->title,
                'user_id'       => Auth::id(),
                'action'        => $action,
            ]);
        }
    }

    /**
     * Log ticket deletion.
     */
    public function deleted(Ticket $ticket): void
    {
        Activity::create([
            'ticket_number' => $ticket->ticket_number,
            'ticket_title'  => $ticket->title,
            'user_id'       => Auth::id(),
            'action'        => 'deleted the ticket',
        ]);
    }
}