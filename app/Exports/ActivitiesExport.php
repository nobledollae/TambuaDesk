<?php

namespace App\Exports;

use App\Models\Activity;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ActivitiesExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Activity::with('user')
            ->latest()
            ->get()
            ->map(function ($activity) {

                return [

                    'Ticket Number' => $activity->ticket_number,

                    'Ticket Title' => $activity->ticket_title,

                    'User' => $activity->user->name ?? 'Unknown',

                    'Action' => $activity->action,

                    'Date' => $activity->created_at->format('d M Y H:i'),

                ];

            });

    }

    public function headings(): array
    {
        return [

            'Ticket Number',

            'Ticket Title',

            'User',

            'Action',

            'Date',

        ];
    }
}