@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')

<!-- Statistics Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

    <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-blue-500">
        <h3 class="text-gray-500 text-sm uppercase font-semibold">
            Open Tickets
        </h3>

        <p class="text-4xl font-bold text-blue-600 mt-3">
            {{ $openTickets }}
        </p>
    </div>

    <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-yellow-500">
        <h3 class="text-gray-500 text-sm uppercase font-semibold">
            Assigned Tickets
        </h3>

        <p class="text-4xl font-bold text-yellow-500 mt-3">
            {{ $assignedTickets }}
        </p>
    </div>

    <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-green-500">
        <h3 class="text-gray-500 text-sm uppercase font-semibold">
            Resolved Tickets
        </h3>

        <p class="text-4xl font-bold text-green-600 mt-3">
            {{ $resolvedTickets }}
        </p>
    </div>

    <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-red-500">
        <h3 class="text-gray-500 text-sm uppercase font-semibold">
            Closed Tickets
        </h3>

        <p class="text-4xl font-bold text-red-600 mt-3">
            {{ $closedTickets }}
        </p>
    </div>

</div>

<!-- Recent Tickets -->
<div class="mt-8 bg-white rounded-xl shadow-md">

    <div class="flex items-center justify-between px-6 py-4 border-b">

        <h2 class="text-xl font-semibold text-gray-800">
            Recent Tickets
        </h2>

        <a href="#"
           class="text-blue-600 hover:text-blue-800 font-medium">
            View All
        </a>

    </div>

    <div class="overflow-x-auto">

        <table class="min-w-full divide-y divide-gray-200">

            <thead class="bg-gray-100">

                <tr>

                    <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider">
                        Ticket No.
                    </th>

                    <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider">
                        Title
                    </th>

                    <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider">
                        Priority
                    </th>

                    <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider">
                        Status
                    </th>

                </tr>

            </thead>

            <tbody class="bg-white divide-y divide-gray-100">

                @forelse($recentTickets as $ticket)

                    <tr class="hover:bg-gray-50 transition">

                        <td class="px-6 py-4 font-medium">
                            {{ $ticket->ticket_number }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $ticket->title }}
                        </td>

                        <td class="px-6 py-4">

                            @if($ticket->priority == 'High')
                                <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-sm">
                                    {{ $ticket->priority }}
                                </span>

                            @elseif($ticket->priority == 'Medium')
                                <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-sm">
                                    {{ $ticket->priority }}
                                </span>

                            @else
                                <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm">
                                    {{ $ticket->priority }}
                                </span>

                            @endif

                        </td>

                        <td class="px-6 py-4">

                            @if($ticket->status == 'Open')
                                <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-sm">
                                    {{ $ticket->status }}
                                </span>

                            @elseif($ticket->status == 'Assigned')
                                <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-sm">
                                    {{ $ticket->status }}
                                </span>

                            @elseif($ticket->status == 'Resolved')
                                <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm">
                                    {{ $ticket->status }}
                                </span>

                            @else
                                <span class="px-3 py-1 rounded-full bg-gray-100 text-gray-700 text-sm">
                                    {{ $ticket->status }}
                                </span>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="4" class="text-center py-8 text-gray-500">

                            No tickets have been created yet.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection