@extends('layouts.app')

@section('title', 'Edit Ticket')

@section('content')

<div class="max-w-4xl mx-auto">

    <div class="bg-white rounded-xl shadow-lg">

        <div class="flex justify-between items-center p-6 border-b">

            <h2 class="text-2xl font-bold">
                Edit Ticket
            </h2>

            <a href="{{ route('tickets.index') }}"
               class="bg-gray-600 hover:bg-gray-700 text-white px-5 py-2 rounded-lg">
                ← Back
            </a>

        </div>

        <form action="{{ route('tickets.update', $ticket) }}" method="POST" class="p-8">

            @csrf
            @method('PUT')

            <div class="mb-6">

                <label class="block font-semibold mb-2">
                    Ticket Number
                </label>

                <input
                    type="text"
                    value="{{ $ticket->ticket_number }}"
                    disabled
                    class="w-full border rounded-lg px-4 py-3 bg-gray-100">

            </div>

            <div class="mb-6">

                <label class="block font-semibold mb-2">
                    Title
                </label>

                <input
                    type="text"
                    name="title"
                    value="{{ old('title', $ticket->title) }}"
                    class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">

                @error('title')
                    <p class="text-red-600 mt-2">{{ $message }}</p>
                @enderror

            </div>

            <div class="mb-6">

                <label class="block font-semibold mb-2">
                    Description
                </label>

                <textarea
                    name="description"
                    rows="6"
                    class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">{{ old('description', $ticket->description) }}</textarea>

                @error('description')
                    <p class="text-red-600 mt-2">{{ $message }}</p>
                @enderror

            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>

                    <label class="block font-semibold mb-2">
                        Priority
                    </label>

                    <select
                        name="priority"
                        class="w-full border rounded-lg px-4 py-3">

                        <option value="Low" {{ $ticket->priority == 'Low' ? 'selected' : '' }}>Low</option>
                        <option value="Medium" {{ $ticket->priority == 'Medium' ? 'selected' : '' }}>Medium</option>
                        <option value="High" {{ $ticket->priority == 'High' ? 'selected' : '' }}>High</option>

                    </select>

                </div>

                <div>

                    <label class="block font-semibold mb-2">
                        Status
                    </label>

                    <select
                        name="status"
                        class="w-full border rounded-lg px-4 py-3">

                        <option value="Open" {{ $ticket->status == 'Open' ? 'selected' : '' }}>Open</option>
                        <option value="Assigned" {{ $ticket->status == 'Assigned' ? 'selected' : '' }}>Assigned</option>
                        <option value="Resolved" {{ $ticket->status == 'Resolved' ? 'selected' : '' }}>Resolved</option>
                        <option value="Closed" {{ $ticket->status == 'Closed' ? 'selected' : '' }}>Closed</option>

                    </select>

                </div>

            </div>

            <div class="mt-8 flex justify-end">

                <button
                    type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-semibold">

                    Update Ticket

                </button>

            </div>

        </form>

    </div>

</div>

@endsection