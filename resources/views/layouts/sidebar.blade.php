<div class="h-full flex flex-col">

    <!-- Logo -->
    <div class="p-6 border-b border-blue-800">

        <h1 class="text-3xl font-bold text-white">
            TambuaDesk
        </h1>

        <p class="text-blue-200 mt-2">
            IT Service Management
        </p>

    </div>

    <!-- Navigation -->
    <nav class="flex-1 mt-6">

        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}"
           class="flex items-center gap-3 px-6 py-3 mx-3 mb-2 rounded-lg hover:bg-blue-800 transition">

            <span>🏠</span>
            <span>Dashboard</span>

        </a>

        <!-- Tickets -->
        <a href="{{ route('tickets.index') }}"
           class="flex items-center gap-3 px-6 py-3 mx-3 mb-2 rounded-lg hover:bg-blue-800 transition">

            <span>🎫</span>
            <span>Tickets</span>

        </a>

        <!-- Admin Only -->
        @if(auth()->user()->role == 'admin')

            <!-- Users -->
            <a href="{{ route('users.index') }}"
               class="flex items-center gap-3 px-6 py-3 mx-3 mb-2 rounded-lg hover:bg-blue-800 transition">

                <span>👥</span>
                <span>Users</span>

            </a>

            <!-- Reports -->
            <a href="{{ route('reports.index') }}"
               class="flex items-center gap-3 px-6 py-3 mx-3 mb-2 rounded-lg hover:bg-blue-800 transition">

                <span>📊</span>
                <span>Reports</span>

            </a>

        @endif

        <a href="{{ route('activities.index') }}"
   class="flex items-center gap-3 px-6 py-3 mx-3 mb-2 rounded-lg
   {{ request()->routeIs('activities.*') ? 'bg-blue-600' : 'hover:bg-blue-800' }} transition">

    <span>📜</span>
    <span>Activity Logs</span>

</a>

        <!-- Settings -->
        <a href="{{ route('profile.edit') }}"
           class="flex items-center gap-3 px-6 py-3 mx-3 mb-2 rounded-lg hover:bg-blue-800 transition">

            <span>⚙️</span>
            <span>Settings</span>

        </a>

    </nav>

</div>