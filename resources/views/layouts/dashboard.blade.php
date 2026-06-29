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
        <header class="bg-white shadow-md">

            <div class="flex justify-between items-center px-8 py-5">

                <div>
                    <h1 class="text-3xl font-bold text-gray-800">
                        @yield('title')
                    </h1>
                </div>

                <div class="flex items-center space-x-4">

                    <div class="text-right">

                        <div class="font-semibold text-gray-800">
                            {{ Auth::user()->name }}
                        </div>

                        <div class="text-sm text-gray-500 capitalize">
                            {{ Auth::user()->role }}
                        </div>

                    </div>

                    <div class="w-12 h-12 rounded-full bg-blue-600 text-white flex items-center justify-center text-lg font-bold">
                        {{ strtoupper(substr(Auth::user()->name,0,1)) }}
                    </div>

                </div>

            </div>

        </header>

        <!-- Page Content -->
        <main class="flex-1 p-8">

            @yield('content')

        </main>

    </div>

</div>

</body>
</html>