@extends('layouts.app')

@section('title', 'Ticket Details')

@section('content')

<div class="max-w-6xl mx-auto">

    @if(session('success'))
        <div class="bg-green-100 border border-green-300 text-green-700 px-5 py-3 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Ticket Details -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow-lg">

            <div class="flex justify-between items-center p-6 border-b">

                <h2 class="text-2xl font-bold">
                    Ticket Details
                </h2>

                <a href="{{ route('tickets.index') }}"
                   class="bg-gray-600 hover:bg-gray-700 text-white px-5 py-2 rounded-lg">
                    ← Back
                </a>

            </div>

            <div class="p-8 space-y-6">

                <div>

                    <span class="text-sm text-gray-500">
                        Ticket Number
                    </span>

                    <h3 class="text-2xl font-bold">
                        {{ $ticket->ticket_number }}
                    </h3>

                </div>

                <div>

                    <span class="text-sm text-gray-500">
                        Title
                    </span>

                    <h2 class="text-xl font-semibold">
                        {{ $ticket->title }}
                    </h2>

                </div>

                <div>

                    <span class="text-sm text-gray-500">
                        Description
                    </span>

                    <div class="mt-2 bg-gray-100 rounded-lg p-4">
                        {{ $ticket->description }}
                    </div>

                </div>

            </div>

        </div>

        <!-- Information Card -->
        <div class="bg-white rounded-xl shadow-lg p-6">

            <h3 class="text-xl font-bold mb-6">
                Ticket Information
            </h3>

            <div class="space-y-5">

                <div>

                    <div class="text-gray-500 text-sm">
                        Status
                    </div>

                    <span class="inline-block mt-1 px-3 py-1 rounded-full bg-blue-100 text-blue-700">
                        {{ $ticket->status }}
                    </span>

                </div>

                <div>

                    <div class="text-gray-500 text-sm">
                        Priority
                    </div>

                    <span class="inline-block mt-1 px-3 py-1 rounded-full bg-red-100 text-red-700">
                        {{ $ticket->priority }}
                    </span>

                </div>

                <div>

                    <div class="text-gray-500 text-sm">
                        Technician
                    </div>

                    <div class="font-semibold">

                        {{ $ticket->technician->name ?? 'Not Assigned' }}

                    </div>

                </div>

                <div>

                    <div class="text-gray-500 text-sm">
                        Created By
                    </div>

                    <div class="font-semibold">

                        {{ $ticket->creator->name ?? 'Unknown' }}

                    </div>

                </div>

                <div>

                    <div class="text-gray-500 text-sm">
                        Created
                    </div>

                    {{ $ticket->created_at->format('d M Y H:i') }}

                </div>

                <div>

                    <div class="text-gray-500 text-sm">
                        Updated
                    </div>

                    {{ $ticket->updated_at->format('d M Y H:i') }}

                </div>

            </div>

        </div>

    </div>

    <!-- Comments -->

    <div class="bg-white rounded-xl shadow-lg mt-8">

        <div class="border-b px-6 py-4">

            <h2 class="text-2xl font-bold">
                Discussion
            </h2>

        </div>

        <div class="p-6">

            @forelse($ticket->comments as $comment)

                <div class="flex space-x-4 mb-6">

                    <div class="w-12 h-12 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold">

                        {{ strtoupper(substr($comment->user->name,0,1)) }}

                    </div>

                    <div class="flex-1">

                        <div class="flex justify-between">

                            <div class="font-semibold">

                                {{ $comment->user->name }}

                            </div>

                            <div class="text-sm text-gray-500">

                                {{ $comment->created_at->diffForHumans() }}

                            </div>

                        </div>

                        <div class="mt-2 bg-gray-100 rounded-lg p-4">

                            {{ $comment->comment }}

                        </div>

                    </div>

                </div>

            @empty

                <div class="text-center text-gray-500 py-8">

                    No comments yet.

                </div>

            @endforelse

        </div>

    </div>

    <!-- Add Comment -->

    <div class="bg-white rounded-xl shadow-lg mt-8">

        <div class="border-b px-6 py-4">

            <h2 class="text-2xl font-bold">

                Add Comment

            </h2>

        </div>

        <form action="{{ route('comments.store', $ticket) }}" method="POST" class="p-6">

            @csrf

            <textarea
                name="comment"
                rows="5"
                class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500"
                placeholder="Write your comment here...">{{ old('comment') }}</textarea>

            @error('comment')

                <p class="text-red-600 mt-2">

                    {{ $message }}

                </p>

            @enderror

            <div class="mt-5 text-right">

                <button
                    type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-semibold">

                    Post Comment

                </button>

            </div>

        </form>

    </div>

</div>

<!-- Activity Timeline -->

<div class="bg-white rounded-xl shadow-lg mt-8">

    <div class="border-b px-6 py-4">

        <h2 class="text-2xl font-bold">
            Activity Timeline
        </h2>

    </div>

    <div class="p-6">

        @forelse($activities as $activity)

            <div class="flex items-start space-x-4 mb-6">

                <div class="w-10 h-10 rounded-full bg-indigo-600 text-white flex items-center justify-center font-bold">

                    {{ strtoupper(substr($activity->user->name ?? 'S', 0, 1)) }}

                </div>

                <div class="flex-1">

                    <div class="flex justify-between">

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

                </div>

            </div>

        @empty

            <div class="text-center text-gray-500 py-6">

                No activity recorded for this ticket.

            </div>

        @endforelse

    </div>

</div>

@endsection