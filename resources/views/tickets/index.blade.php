@extends('layouts.app')

@section('title', 'Tickets')

@section('content')

<div class="bg-white rounded-xl shadow-lg">

    <div class="flex justify-between items-center p-6 border-b">

        <h2 class="text-2xl font-bold">
            Ticket Management
        </h2>

        <a href="{{ route('tickets.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg font-semibold">
            + Create Ticket
        </a>

    </div>

    <div class="overflow-x-auto">

        <table class="w-full">

            <thead class="bg-gray-100">
                <tr>
                    <th class="p-4 text-left">Ticket No.</th>
                    <th class="p-4 text-left">Title</th>
                    <th class="p-4 text-left">Priority</th>
                    <th class="p-4 text-left">Status</th>
                    <th class="p-4 text-left">Technician</th>
                    <th class="p-4 text-center">Actions</th>
                </tr>
            </thead>

            <tbody>

            @forelse($tickets as $ticket)

                <tr class="border-b hover:bg-gray-50">

                    <td class="p-4">
                        {{ $ticket->ticket_number }}
                    </td>

                    <td class="p-4">
                        {{ $ticket->title }}
                    </td>

                    <td class="p-4">
                        <span class="px-3 py-1 rounded-full bg-red-100 text-red-700">
                            {{ $ticket->priority }}
                        </span>
                    </td>

                    {{-- STATUS --}}
                    <td class="p-4">
                        <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700">
                            {{ $ticket->status }}
                        </span>
                    </td>

                    {{-- TECHNICIAN --}}
                    <td class="p-4">

                        @if($ticket->technician)

                            <span class="text-green-700 font-semibold">
                                {{ $ticket->technician->name }}
                            </span>

                        @else

                            <span class="text-gray-500 italic">
                                Not Assigned
                            </span>

                        @endif

                    </td>

                    {{-- ACTIONS --}}
                    <td class="p-4">

                        <div class="flex justify-center items-center gap-4">

                            <a href="{{ route('tickets.show', $ticket) }}"
                               class="text-blue-600 hover:text-blue-800 font-semibold">
                                View
                            </a>

                            <a href="{{ route('tickets.edit', $ticket) }}"
                               class="text-green-600 hover:text-green-800 font-semibold">
                                Edit
                            </a>

                            <form action="{{ route('tickets.destroy', $ticket) }}"
                                  method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete this ticket?');">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="text-red-600 hover:text-red-800 font-semibold">
                                    Delete
                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="6" class="text-center py-10 text-gray-500">
                        No tickets found.
                    </td>
                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

    <div class="p-6">
        {{ $tickets->links() }}
    </div>

</div>

@endsection