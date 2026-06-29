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

        <a href="{{ route('dashboard') }}"
           class="flex items-center gap-3 px-6 py-3 mx-3 mb-2 rounded-lg bg-blue-600 hover:bg-blue-500 transition">

            <span>🏠</span>
            <span>Dashboard</span>

        </a>

        <a href="{{ route('tickets.index') }}"
           class="flex items-center gap-3 px-6 py-3 mx-3 mb-2 rounded-lg hover:bg-blue-800 transition">

            <span>🎫</span>
            <span>Tickets</span>

        </a>

        @if(Auth::user()->role == 'admin')

        <a href="#"
           class="flex items-center gap-3 px-6 py-3 mx-3 mb-2 rounded-lg hover:bg-blue-800 transition">

            <span>👥</span>
            <span>Users</span>

        </a>

        <a href="#"
           class="flex items-center gap-3 px-6 py-3 mx-3 mb-2 rounded-lg hover:bg-blue-800 transition">

            <span>📊</span>
            <span>Reports</span>

        </a>

        @endif

        <a href="{{ route('profile.edit') }}"
           class="flex items-center gap-3 px-6 py-3 mx-3 mb-2 rounded-lg hover:bg-blue-800 transition">

            <span>⚙️</span>
            <span>Settings</span>

        </a>

    </nav>

</div>