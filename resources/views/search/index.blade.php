@extends('layouts.app')

@section('title', 'Search Results')

@section('content')

<div class="max-w-7xl mx-auto space-y-8">

    {{-- Search Header --}}
    <div class="bg-white rounded-xl shadow p-6">

        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

            <div>

                <h1 class="text-3xl font-bold">
                    Search Results
                </h1>

                <p class="text-gray-500 mt-2">
                    Results for:
                    <span class="font-semibold text-blue-600">
                        "{{ $search }}"
                    </span>
                </p>

            </div>

            <a href="{{ url()->previous() }}"
               class="bg-gray-600 hover:bg-gray-700 text-white px-5 py-2 rounded-lg text-center">

                ← Back

            </a>

        </div>

        {{-- Search Form --}}
        <form action="{{ route('search') }}" method="GET" class="mt-6">

            <div class="flex gap-3">

                <div class="relative flex-1">

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search tickets, users or activities..."
                        class="w-full border rounded-lg px-4 py-3 pr-12 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                    @if(request('search'))

                        <a href="{{ route('search') }}"
                           class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 hover:text-red-600 text-xl font-bold">

                            ×

                        </a>

                    @endif

                </div>

                <button
                    type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-8 rounded-lg font-semibold">

                    Search

                </button>

            </div>

        </form>

    </div>

    {{-- Tickets --}}
    <div class="bg-white rounded-xl shadow">

        <div class="border-b p-5">

            <h2 class="text-xl font-bold">
                Tickets ({{ $tickets->count() }})
            </h2>

        </div>

        @if($tickets->count())

            <table class="w-full">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="text-left p-4">Ticket</th>
                        <th class="text-left p-4">Title</th>
                        <th class="text-left p-4">Status</th>
                        <th class="text-left p-4">Action</th>

                    </tr>

                </thead>

                <tbody>

                @foreach($tickets as $ticket)

                    <tr class="border-b hover:bg-gray-50">

                        <td class="p-4">
                            {{ $ticket->ticket_number }}
                        </td>

                        <td class="p-4">
                            {{ $ticket->title }}
                        </td>

                        <td class="p-4">

                            <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700">

                                {{ $ticket->status }}

                            </span>

                        </td>

                        <td class="p-4">

                            <a href="{{ route('tickets.show', $ticket) }}"
                               class="text-blue-600 hover:text-blue-800 font-semibold">

                                View

                            </a>

                        </td>

                    </tr>

                @endforeach

                </tbody>

            </table>

        @else

            <div class="p-6 text-gray-500 text-center">

                No matching tickets found.

            </div>

        @endif

    </div>

    {{-- Users --}}
    @if(auth()->user()->role == 'admin')

    <div class="bg-white rounded-xl shadow">

        <div class="border-b p-5">

            <h2 class="text-xl font-bold">

                Users ({{ $users->count() }})

            </h2>

        </div>

        @if($users->count())

            <table class="w-full">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="text-left p-4">Name</th>
                        <th class="text-left p-4">Email</th>
                        <th class="text-left p-4">Role</th>

                    </tr>

                </thead>

                <tbody>

                @foreach($users as $user)

                    <tr class="border-b hover:bg-gray-50">

                        <td class="p-4">

                            {{ $user->name }}

                        </td>

                        <td class="p-4">

                            {{ $user->email }}

                        </td>

                        <td class="p-4">

                            {{ ucfirst($user->role) }}

                        </td>

                    </tr>

                @endforeach

                </tbody>

            </table>

        @else

            <div class="p-6 text-gray-500 text-center">

                No matching users found.

            </div>

        @endif

    </div>

    @endif

    {{-- Activities --}}
    <div class="bg-white rounded-xl shadow">

        <div class="border-b p-5">

            <h2 class="text-xl font-bold">

                Activities ({{ $activities->count() }})

            </h2>

        </div>

        @if($activities->count())

            <div class="divide-y">

                @foreach($activities as $activity)

                    <div class="p-5">

                        <div class="flex justify-between items-center">

                            <div>

                                <span class="font-semibold">

                                    {{ $activity->user->name ?? 'System' }}

                                </span>

                                <span class="text-gray-600">

                                    {{ $activity->action }}

                                </span>

                            </div>

                            <div class="text-sm text-gray-500">

                                {{ $activity->created_at->diffForHumans() }}

                            </div>

                        </div>

                        <div class="mt-2 text-sm text-gray-500">

                            Ticket:
                            <span class="font-medium">

                                {{ $activity->ticket_number }}

                            </span>

                        </div>

                    </div>

                @endforeach

            </div>

        @else

            <div class="p-6 text-gray-500 text-center">

                No matching activities found.

            </div>

        @endif

    </div>

</div>

@endsection