<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-100">

<div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-72 bg-gradient-to-b from-slate-900 via-blue-900 to-blue-700 text-white shadow-2xl">

        @include('layouts.sidebar')

    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">

        <!-- Top Bar -->
        <header class="bg-white shadow">

            <div class="flex justify-between items-center px-8 py-5">

                <!-- Page Title -->
                <h1 class="text-3xl font-bold text-gray-800">
                    @yield('title')
                </h1>

                <!-- Right Side -->
                <div class="flex items-center gap-6">

                    <!-- Search -->
                    <form action="{{ route('search') }}" method="GET" class="flex-1 max-w-md">

    <input
        type="text"
        name="search"
        value="{{ request('search') }}"
        placeholder="Search tickets, users..."
        class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">

</form>
                   <!-- Notification Dropdown -->
<div class="relative" id="notificationDropdown">

    <button
        id="notificationButton"
        class="relative text-2xl hover:text-blue-600 transition">

        🔔

        <span
            id="notificationCount"
            class="absolute -top-2 -right-2 bg-red-600 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center
            {{ auth()->user()->unreadNotifications->count() ? '' : 'hidden' }}">

            {{ auth()->user()->unreadNotifications->count() }}

        </span>

    </button>

    <div
        id="notificationMenu"
        class="hidden absolute right-0 mt-4 w-96 bg-white rounded-xl shadow-2xl border z-50">

        <div class="flex justify-between items-center px-5 py-4 border-b">

            <h2 class="font-bold text-lg">

                Notifications

            </h2>

            <a
                href="{{ route('notifications.readAll') }}"
                onclick="event.preventDefault();document.getElementById('readAllForm').submit();"
                class="text-sm text-blue-600 hover:underline">

                Mark all as read

            </a>

            <form
                id="readAllForm"
                action="{{ route('notifications.readAll') }}"
                method="POST">

                @csrf
                @method('PATCH')

            </form>

        </div>

        <div
            id="notificationList"
            class="max-h-96 overflow-y-auto">

            @forelse(auth()->user()->notifications->take(8) as $notification)

                <a
                    href="{{ route('notifications.read',$notification->id) }}"
                    onclick="event.preventDefault();document.getElementById('notification-{{ $notification->id }}').submit();"
                    class="block px-5 py-4 border-b hover:bg-gray-50">

                    <div class="font-semibold">

                        {{ $notification->data['title'] ?? 'Notification' }}

                    </div>

                    <div class="text-sm text-gray-500 mt-1">

                        {{ $notification->data['message'] ?? '' }}

                    </div>

                    <div class="text-xs text-gray-400 mt-2">

                        {{ $notification->created_at->diffForHumans() }}

                    </div>

                </a>

                <form
                    id="notification-{{ $notification->id }}"
                    action="{{ route('notifications.read',$notification->id) }}"
                    method="POST">

                    @csrf
                    @method('PATCH')

                </form>

            @empty

                <div class="text-center text-gray-500 py-8">

                    No notifications.

                </div>

            @endforelse

        </div>

        <div class="p-4 border-t text-center">

            <a
                href="{{ route('notifications.index') }}"
                class="text-blue-600 hover:underline font-semibold">

                View All Notifications

            </a>

        </div>

    </div>

</div>

                    <!-- User Details -->
                    <div class="text-right">

                        <div class="font-bold text-gray-800">

                            {{ Auth::user()->name }}

                        </div>

                        <div class="text-sm text-blue-600 capitalize">

                            {{ Auth::user()->role }}

                        </div>

                    </div>

                   <!-- Avatar -->
<div class="relative">

    <img
        src="{{ Auth::user()->profile_photo_url }}"
        alt="Profile Photo"
        class="w-12 h-12 rounded-full object-cover border-2 border-blue-600 shadow">

    <span class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 border-2 border-white rounded-full"></span>

</div>

                    <!-- Logout -->
                    <form method="POST" action="{{ route('logout') }}">

                        @csrf

                        <button
                            type="submit"
                            class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-semibold transition">

                            🚪 Logout

                        </button>

                    </form>

                </div>

            </div>

        </header>

        <!-- Page Content -->
        <main class="flex-1 p-8">

            @yield('content')

        </main>

    </div>

</div>

<script>

const notificationButton =
document.getElementById('notificationButton');

const notificationMenu =
document.getElementById('notificationMenu');

notificationButton.addEventListener('click',function(e){

    e.stopPropagation();

    notificationMenu.classList.toggle('hidden');

});

document.addEventListener('click',function(){

    notificationMenu.classList.add('hidden');

});

notificationMenu.addEventListener('click',function(e){

    e.stopPropagation();

});

</script>

</body>
</html>