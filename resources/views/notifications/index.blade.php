@extends('layouts.app')

@section('title', 'Notifications')

@section('content')

<div class="flex items-center justify-between mb-8">

    <div>

        <h1 class="text-3xl font-bold">
            Notification Center
        </h1>

        <p class="text-gray-500">
            Stay up to date with everything happening in TambuaDesk.
        </p>

    </div>

    <a
        href="{{ route('dashboard') }}"
        class="bg-gray-200 hover:bg-gray-300 px-5 py-2 rounded-lg">

        ← Dashboard

    </a>

</div>

<div class="bg-white rounded-xl shadow-lg">

    <div class="border-b px-6 py-5 flex justify-between items-center">

        <h2 class="text-xl font-bold">

            All Notifications

        </h2>

        <form
            method="POST"
            action="{{ route('notifications.readAll') }}">

            @csrf
            @method('PATCH')

            <button
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">

                Mark All Read

            </button>

        </form>

    </div>

    <div class="divide-y">

        @forelse($notifications as $notification)

            <div
                class="flex justify-between items-center px-6 py-5 {{ $notification->read_at ? 'bg-white' : 'bg-blue-50' }}">

                <div class="flex-1">

                    <div class="flex items-center gap-3">

                        @if(!$notification->read_at)

                            <span
                                class="w-3 h-3 rounded-full bg-blue-600"></span>

                        @endif

                        <h3 class="font-semibold text-lg">

                            {{ $notification->data['title'] ?? 'Notification' }}

                        </h3>

                    </div>

                    <p class="text-gray-600 mt-2">

                        {{ $notification->data['message'] ?? '' }}

                    </p>

                    <div class="text-sm text-gray-400 mt-3">

                        {{ $notification->created_at->format('d M Y • h:i A') }}

                        ({{ $notification->created_at->diffForHumans() }})

                    </div>

                </div>

                <div class="ml-6">

                    @if(!$notification->read_at)

                        <form
                            method="POST"
                            action="{{ route('notifications.read', $notification->id) }}">

                            @csrf
                            @method('PATCH')

                            <button
                                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">

                                Mark Read

                            </button>

                        </form>

                    @else

                        <span
                            class="bg-green-100 text-green-700 px-4 py-2 rounded-lg">

                            ✓ Read

                        </span>

                    @endif

                </div>

            </div>

        @empty

            <div class="text-center py-16 text-gray-500">

                <div class="text-6xl mb-4">

                    🔔

                </div>

                <div class="text-xl font-semibold">

                    No notifications yet.

                </div>

                <div class="mt-2">

                    New activity will appear here.

                </div>

            </div>

        @endforelse

    </div>

    @if($notifications->hasPages())

        <div class="p-6 border-t">

            {{ $notifications->links() }}

        </div>

    @endif

</div>

@endsection