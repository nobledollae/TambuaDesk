@extends('layouts.app')

@section('title', 'Reports')

@section('content')

<div class="space-y-8">

    <div>
        <h1 class="text-3xl font-bold text-gray-800">
            Reports Dashboard
        </h1>

        <p class="text-gray-500 mt-2">
            System statistics and ticket analytics.
        </p>
    </div>

    <!-- Ticket Statistics -->

    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-6">

        <div class="bg-white rounded-xl shadow p-6">
            <p class="text-gray-500">Total Tickets</p>
            <h2 class="text-3xl font-bold mt-2">{{ $totalTickets }}</h2>
        </div>

        <div class="bg-blue-50 rounded-xl shadow p-6">
            <p class="text-blue-600">Open</p>
            <h2 class="text-3xl font-bold mt-2">{{ $openTickets }}</h2>
        </div>

        <div class="bg-yellow-50 rounded-xl shadow p-6">
            <p class="text-yellow-700">Assigned</p>
            <h2 class="text-3xl font-bold mt-2">{{ $assignedTickets }}</h2>
        </div>

        <div class="bg-indigo-50 rounded-xl shadow p-6">
            <p class="text-indigo-700">In Progress</p>
            <h2 class="text-3xl font-bold mt-2">{{ $inProgressTickets }}</h2>
        </div>

        <div class="bg-green-50 rounded-xl shadow p-6">
            <p class="text-green-700">Resolved</p>
            <h2 class="text-3xl font-bold mt-2">{{ $resolvedTickets }}</h2>
        </div>

        <div class="bg-gray-100 rounded-xl shadow p-6">
            <p class="text-gray-700">Closed</p>
            <h2 class="text-3xl font-bold mt-2">{{ $closedTickets }}</h2>
        </div>

    </div>

    <!-- Priority Statistics -->

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

        <div class="bg-green-100 rounded-xl shadow p-6">
            <p class="font-semibold">Low Priority</p>
            <h2 class="text-2xl font-bold mt-2">{{ $lowPriority }}</h2>
        </div>

        <div class="bg-yellow-100 rounded-xl shadow p-6">
            <p class="font-semibold">Medium Priority</p>
            <h2 class="text-2xl font-bold mt-2">{{ $mediumPriority }}</h2>
        </div>

        <div class="bg-orange-100 rounded-xl shadow p-6">
            <p class="font-semibold">High Priority</p>
            <h2 class="text-2xl font-bold mt-2">{{ $highPriority }}</h2>
        </div>

        <div class="bg-red-100 rounded-xl shadow p-6">
            <p class="font-semibold">Critical Priority</p>
            <h2 class="text-2xl font-bold mt-2">{{ $criticalPriority }}</h2>
        </div>

    </div>

    <!-- Technician Workload -->

    <div class="bg-white rounded-xl shadow">

        <div class="p-6 border-b">

            <h2 class="text-xl font-bold">
                Technician Workload
            </h2>

        </div>

        <table class="w-full">

            <thead class="bg-gray-100">

                <tr>

                    <th class="text-left p-4">Technician</th>

                    <th class="text-center p-4">Assigned Tickets</th>

                </tr>

            </thead>

            <tbody>

            @foreach($technicians as $technician)

                <tr class="border-b">

                    <td class="p-4">

                        {{ $technician->name }}

                    </td>

                    <td class="text-center p-4 font-semibold">

                        {{ $technician->assigned_tickets_count }}

                    </td>

                </tr>

            @endforeach

            </tbody>

        </table>

    </div>

</div>

@endsection