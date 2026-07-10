@extends('layouts.app')

@section('title', 'Users')

@section('content')

@if(session('success'))

<div class="mx-6 mt-6 bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-lg">

    {{ session('success') }}

</div>

@endif

<div class="bg-white rounded-xl shadow-lg">

    <div class="flex justify-between items-center p-6 border-b">

        <h2 class="text-2xl font-bold">
            User Management
        </h2>

        <a href="{{ route('users.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg font-semibold">
            + Add User
        </a>

    </div>

    <div class="overflow-x-auto">

        <table class="w-full">

            <thead class="bg-gray-100">

                <tr>

                    <th class="p-4 text-left">Name</th>
                    <th class="p-4 text-left">Email</th>
                    <th class="p-4 text-left">Role</th>
                    <th class="p-4 text-left">Status</th>
                    <th class="p-4 text-center">Actions</th>

                </tr>

            </thead>

            <tbody>

            @forelse($users as $user)

                <tr class="border-b hover:bg-gray-50">

                    <td class="p-4 font-semibold">
                        {{ $user->name }}
                    </td>

                    <td class="p-4">
                        {{ $user->email }}
                    </td>

                    <td class="p-4">

                        @if($user->role == 'admin')

                            <span class="px-3 py-1 rounded-full bg-red-100 text-red-700">
                                Admin
                            </span>

                        @elseif($user->role == 'technician')

                            <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700">
                                Technician
                            </span>

                        @else

                            <span class="px-3 py-1 rounded-full bg-green-100 text-green-700">
                                Employee
                            </span>

                        @endif

                    </td>

                    <td class="p-4">

                        @if($user->status == 'Active')

                            <span class="px-3 py-1 rounded-full bg-green-100 text-green-700">
                                Active
                            </span>

                        @else

                            <span class="px-3 py-1 rounded-full bg-red-100 text-red-700">
                                Inactive
                            </span>

                        @endif

                    </td>

                    <td class="p-4">

                        <div class="flex justify-center space-x-4">

                            <a href="{{ route('users.show',$user) }}"
                               class="text-blue-600 font-semibold hover:text-blue-800">
                                View
                            </a>

                            <a href="{{ route('users.edit',$user) }}"
                               class="text-green-600 font-semibold hover:text-green-800">
                                Edit
                            </a>

                            <form action="{{ route('users.destroy',$user) }}"
                                  method="POST"
                                  onsubmit="return confirm('Delete this user?')">

                                @csrf
                                @method('DELETE')

                                <button
                                    class="text-red-600 font-semibold hover:text-red-800">

                                    Delete

                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="5"
                        class="text-center py-10 text-gray-500">

                        No users found.

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

    <div class="p-6">

        {{ $users->links() }}

    </div>

</div>

@endsection