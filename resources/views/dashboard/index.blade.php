@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="space-y-8">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row justify-between md:items-center gap-4">

        <div>

            <h1 class="text-3xl font-bold">
                Welcome, {{ auth()->user()->name }}
            </h1>

            <p class="text-gray-500 mt-2">
                Here's what's happening in TambuaDesk today.
            </p>

        </div>

        @if(auth()->user()->role == 'admin')
            <a href="{{ route('activities.export.excel') }}"
               class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg shadow">

                Export Activities

            </a>
        @endif

    </div>

    {{-- Statistics --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

        <div class="bg-white rounded-xl shadow p-6">
            <p class="text-gray-500">Open Tickets</p>
            <h2 class="text-4xl font-bold text-blue-600">
                {{ $openTickets }}
            </h2>
        </div>

        <div class="bg-white rounded-xl shadow p-6">
            <p class="text-gray-500">Assigned</p>
            <h2 class="text-4xl font-bold text-yellow-600">
                {{ $assignedTickets }}
            </h2>
        </div>

        <div class="bg-white rounded-xl shadow p-6">
            <p class="text-gray-500">Resolved</p>
            <h2 class="text-4xl font-bold text-green-600">
                {{ $resolvedTickets }}
            </h2>
        </div>

        <div class="bg-white rounded-xl shadow p-6">
            <p class="text-gray-500">Closed</p>
            <h2 class="text-4xl font-bold text-gray-700">
                {{ $closedTickets }}
            </h2>
        </div>

    </div>

    {{-- Recent Tickets --}}
    <div class="bg-white rounded-xl shadow">

        <div class="border-b p-6 flex justify-between items-center">

            <h2 class="text-xl font-bold">
                Recent Tickets
            </h2>

            <a href="{{ route('tickets.index') }}"
               class="text-blue-600 hover:underline">

                View All

            </a>

        </div>

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="p-4 text-left">Ticket</th>
                        <th class="p-4 text-left">Title</th>
                        <th class="p-4 text-left">Priority</th>
                        <th class="p-4 text-left">Status</th>
                        <th class="p-4 text-center">Action</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($recentTickets as $ticket)

                        <tr class="border-b hover:bg-gray-50">

                            <td class="p-4 font-medium">
                                {{ $ticket->ticket_number }}
                            </td>

                            <td class="p-4">
                                {{ $ticket->title }}
                            </td>

                            <td class="p-4">

                                @if($ticket->priority == 'Critical')

                                    <span class="px-3 py-1 rounded-full bg-red-600 text-white">
                                        {{ $ticket->priority }}
                                    </span>

                                @elseif($ticket->priority == 'High')

                                    <span class="px-3 py-1 rounded-full bg-red-100 text-red-700">
                                        {{ $ticket->priority }}
                                    </span>

                                @elseif($ticket->priority == 'Medium')

                                    <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700">
                                        {{ $ticket->priority }}
                                    </span>

                                @else

                                    <span class="px-3 py-1 rounded-full bg-green-100 text-green-700">
                                        {{ $ticket->priority }}
                                    </span>

                                @endif

                            </td>

                            <td class="p-4">

                                @switch($ticket->status)

                                    @case('Open')
                                        <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700">
                                            Open
                                        </span>
                                        @break

                                    @case('Assigned')
                                        <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700">
                                            Assigned
                                        </span>
                                        @break

                                    @case('In Progress')
                                        <span class="px-3 py-1 rounded-full bg-orange-100 text-orange-700">
                                            In Progress
                                        </span>
                                        @break

                                    @case('Resolved')
                                        <span class="px-3 py-1 rounded-full bg-green-100 text-green-700">
                                            Resolved
                                        </span>
                                        @break

                                    @default
                                        <span class="px-3 py-1 rounded-full bg-gray-200 text-gray-700">
                                            Closed
                                        </span>

                                @endswitch

                            </td>

                            <td class="p-4 text-center">

                                <a href="{{ route('tickets.show',$ticket) }}"
                                   class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">

                                    View

                                </a>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5" class="text-center p-8 text-gray-500">

                                No tickets available.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

    {{-- Quick Actions --}}
    <div class="bg-white rounded-xl shadow p-6">

        <h2 class="text-xl font-bold mb-5">

            Quick Actions

        </h2>

        <div class="flex flex-wrap gap-4">

            @if(auth()->user()->role != 'technician')

                <a href="{{ route('tickets.create') }}"
                   class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg">

                    + Create Ticket

                </a>

            @endif

            @if(auth()->user()->role == 'admin')

                <a href="{{ route('users.index') }}"
                   class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg">

                    Manage Users

                </a>

                <a href="{{ route('reports.index') }}"
                   class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-3 rounded-lg">

                    Reports

                </a>

            @endif

        </div>

    </div>

</div>

@endsection