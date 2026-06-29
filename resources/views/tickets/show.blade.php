@extends('layouts.app')

@section('title', 'Ticket Details')

@section('content')

<div class="bg-white rounded-xl shadow-lg">

    <div class="flex justify-between items-center p-6 border-b">

        <h2 class="text-2xl font-bold">
            Ticket Details
        </h2>

        <a href="{{ route('tickets.index') }}"
           class="bg-gray-600 hover:bg-gray-700 text-white px-5 py-2 rounded-lg">
            ← Back
        </a>

    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-8">

        <div>
            <label class="text-gray-500 text-sm">Ticket Number</label>

            <p class="text-xl font-semibold">
                {{ $ticket->ticket_number }}
            </p>
        </div>

        <div>
            <label class="text-gray-500 text-sm">Status</label>

            <p>
                <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700">
                    {{ $ticket->status }}
                </span>
            </p>
        </div>

        <div>
            <label class="text-gray-500 text-sm">Priority</label>

            <p>
                <span class="px-3 py-1 rounded-full bg-red-100 text-red-700">
                    {{ $ticket->priority }}
                </span>
            </p>
        </div>

        <div>
            <label class="text-gray-500 text-sm">Created By</label>

            <p class="font-semibold">
                {{ $ticket->user->name ?? 'Unknown' }}
            </p>
        </div>

        <div class="md:col-span-2">

            <label class="text-gray-500 text-sm">
                Title
            </label>

            <p class="text-lg font-semibold">
                {{ $ticket->title }}
            </p>

        </div>

        <div class="md:col-span-2">

            <label class="text-gray-500 text-sm">
                Description
            </label>

            <div class="mt-2 p-4 bg-gray-100 rounded-lg">

                {{ $ticket->description }}

            </div>

        </div>

        <div>

            <label class="text-gray-500 text-sm">
                Created At
            </label>

            <p>

                {{ $ticket->created_at->format('d M Y H:i') }}

            </p>

        </div>

        <div>

            <label class="text-gray-500 text-sm">
                Last Updated
            </label>

            <p>

                {{ $ticket->updated_at->format('d M Y H:i') }}

            </p>

        </div>

    </div>

</div>

@endsection