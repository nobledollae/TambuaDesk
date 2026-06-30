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
    <aside class="w-64 min-h-screen bg-gradient-to-b from-slate-900 via-blue-900 to-blue-700 text-white shadow-2xl">

        @include('layouts.sidebar')

    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">

        <!-- Top Navigation -->
        <header class="bg-white shadow-md border-b">

            <div class="flex justify-between items-center px-8 py-5">

                <!-- Left -->
                <div>

                    <h1 class="text-3xl font-bold text-gray-800">
                        @yield('title')
                    </h1>

                    <p class="text-sm text-gray-500 mt-1">
                        {{ now()->format('l, d F Y') }}
                    </p>

                </div>

                <!-- Right -->
                <div class="flex items-center space-x-6">

                    <!-- User Info -->
                    <div class="text-right">

                        <div class="font-bold text-gray-800">
                            {{ Auth::user()->name }}
                        </div>

                        <div class="text-sm text-blue-600 capitalize">
                            {{ Auth::user()->role }}
                        </div>

                    </div>

                    <!-- Avatar -->
                    <div class="w-12 h-12 rounded-full bg-blue-600 text-white flex items-center justify-center text-lg font-bold shadow">

                        {{ strtoupper(substr(Auth::user()->name,0,1)) }}

                    </div>

                    <!-- Profile -->
                    <a href="{{ route('profile.edit') }}"
                       class="bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded-lg font-medium transition">

                        Profile

                    </a>

                    <!-- Logout -->
                    <form method="POST" action="{{ route('logout') }}">

                        @csrf

                        <button
                            type="submit"
                            class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-lg font-semibold transition">

                            Logout

                        </button>

                    </form>

                </div>

            </div>

        </header>

        <!-- Content -->
        <main class="flex-1 p-8">

            @yield('content')

        </main>

    </div>

</div>

</body>
</html>