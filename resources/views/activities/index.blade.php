@extends('layouts.app')

@section('title', 'Activity Logs')

@section('content')

<div class="space-y-6">

    <!-- Header -->
    <div class="flex justify-between items-center">

        <div>
            <h2 class="text-3xl font-bold text-gray-800">
                Activity Logs
            </h2>

            <p class="text-gray-500 mt-2">
                View all actions performed within TambuaDesk.
            </p>
        </div>

    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <div class="bg-white rounded-xl shadow p-6">
            <p class="text-gray-500">Total Activities</p>
            <h2 class="text-4xl font-bold text-blue-600">
                {{ $activities->total() }}
            </h2>
        </div>

        <div class="bg-white rounded-xl shadow p-6">
            <p class="text-gray-500">Today's Activities</p>
            <h2 class="text-4xl font-bold text-green-600">
                {{ \App\Models\Activity::whereDate('created_at', today())->count() }}
            </h2>
        </div>

        <div class="bg-white rounded-xl shadow p-6">
            <p class="text-gray-500">Registered Users</p>
            <h2 class="text-4xl font-bold text-purple-600">
                {{ \App\Models\User::count() }}
            </h2>
        </div>

    </div>

    <!-- Activity Table -->
    <div class="bg-white rounded-xl shadow">

        <div class="border-b p-6">

            <h3 class="text-xl font-bold">
                Recent Activity
            </h3>

        </div>

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="p-4 text-left">User</th>
                        <th class="p-4 text-left">Role</th>
                        <th class="p-4 text-left">Ticket</th>
                        <th class="p-4 text-left">Action</th>
                        <th class="p-4 text-left">Time</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($activities as $activity)

                    <tr class="border-b hover:bg-gray-50">

                        <!-- User -->
                        <td class="p-4 font-semibold">
                            {{ $activity->user?->name ?? 'System' }}
                        </td>

                        <!-- Role -->
                        <td class="p-4 capitalize">
                            {{ $activity->user?->role ?? '-' }}
                        </td>

                        <!-- Ticket -->
                        <td class="p-4">

                            <div class="font-semibold text-blue-700">
                                {{ $activity->ticket_number ?? 'N/A' }}
                            </div>

                            <div class="text-sm text-gray-500">
                                {{ $activity->ticket_title ?? 'Deleted Ticket' }}
                            </div>

                        </td>

                        <!-- Action -->
                        <td class="p-4">

                            <span class="inline-flex px-3 py-1 rounded-full bg-blue-100 text-blue-700 font-medium">

                                {{ $activity->action }}

                            </span>

                        </td>

                        <!-- Time -->
                        <td class="p-4 text-gray-500">
                            {{ $activity->created_at->diffForHumans() }}
                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5" class="text-center py-8 text-gray-500">

                            No activities recorded.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

        <!-- Pagination -->
        <div class="p-6">

            {{ $activities->links() }}

        </div>

    </div>

</div>

@endsection