@extends('layouts.app')

@section('title', 'Tickets')

@section('content')

<div class="bg-white rounded-xl shadow-lg">

    {{-- Header --}}
    <div class="flex justify-between items-center p-6 border-b">

        <h2 class="text-2xl font-bold">
            Ticket Management
        </h2>

        @if(auth()->user()->role != 'technician')
            <a href="{{ route('tickets.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg font-semibold">
                + Create Ticket
            </a>
        @endif

    </div>

    {{-- Filters --}}
    <div class="p-6 border-b bg-gray-50">

        <form method="GET" action="{{ route('tickets.index') }}">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">

                {{-- Search --}}
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search ticket..."
                    class="border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">

                {{-- Status --}}
                <select
                    name="status"
                    class="border rounded-lg px-4 py-2">

                    <option value="">All Statuses</option>

                    @foreach(['Open','Assigned','In Progress','Resolved','Closed'] as $status)

                        <option value="{{ $status }}"
                            {{ request('status') == $status ? 'selected' : '' }}>

                            {{ $status }}

                        </option>

                    @endforeach

                </select>

                {{-- Priority --}}
                <select
                    name="priority"
                    class="border rounded-lg px-4 py-2">

                    <option value="">All Priorities</option>

                    @foreach(['Low','Medium','High','Critical'] as $priority)

                        <option value="{{ $priority }}"
                            {{ request('priority') == $priority ? 'selected' : '' }}>

                            {{ $priority }}

                        </option>

                    @endforeach

                </select>

                {{-- Technician (Admin only) --}}
                @if(auth()->user()->role == 'admin')

                    <select
                        name="assigned_to"
                        class="border rounded-lg px-4 py-2">

                        <option value="">All Technicians</option>

                        @foreach($technicians as $tech)

                            <option value="{{ $tech->id }}"
                                {{ request('assigned_to') == $tech->id ? 'selected' : '' }}>

                                {{ $tech->name }}

                            </option>

                        @endforeach

                    </select>

                @else

                    <div></div>

                @endif

                {{-- Buttons --}}
                <div class="flex gap-2">

                    <button
                        type="submit"
                        class="flex-1 bg-blue-600 hover:bg-blue-700 text-white rounded-lg px-4 py-2">

                        Filter

                    </button>

                    <a href="{{ route('tickets.index') }}"
                       class="flex-1 bg-gray-500 hover:bg-gray-600 text-white rounded-lg px-4 py-2 text-center">

                        Reset

                    </a>

                </div>

            </div>

        </form>

    </div>

    {{-- Tickets Table --}}
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

                    <td class="p-4">

                        <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700">

                            {{ $ticket->status }}

                        </span>

                    </td>

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

                    <td class="p-4">

                        <div class="flex justify-center gap-4">

                            <a href="{{ route('tickets.show',$ticket) }}"
                               class="text-blue-600 hover:text-blue-800 font-semibold">

                                View

                            </a>

                            @if(auth()->user()->role != 'employee')

                                <a href="{{ route('tickets.edit',$ticket) }}"
                                   class="text-green-600 hover:text-green-800 font-semibold">

                                    Edit

                                </a>

                            @endif

                            @if(auth()->user()->role == 'admin')

                                <form method="POST"
                                      action="{{ route('tickets.destroy',$ticket) }}"
                                      onsubmit="return confirm('Delete this ticket?')">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="text-red-600 hover:text-red-800 font-semibold">

                                        Delete

                                    </button>

                                </form>

                            @endif

                        </div>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="6"
                        class="text-center py-8 text-gray-500">

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