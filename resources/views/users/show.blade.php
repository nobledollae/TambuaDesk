@extends('layouts.app')

@section('title', 'User Details')

@section('content')

<div class="max-w-4xl mx-auto">

    <div class="bg-white rounded-xl shadow-lg">

        <div class="flex justify-between items-center p-6 border-b">

            <h2 class="text-2xl font-bold">
                User Details
            </h2>

            <a href="{{ route('users.index') }}"
               class="bg-gray-600 hover:bg-gray-700 text-white px-5 py-2 rounded-lg">
                ← Back
            </a>

        </div>

        <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-8">

            <div>
                <label class="text-gray-500 text-sm">Full Name</label>

                <p class="text-xl font-semibold">
                    {{ $user->name }}
                </p>
            </div>

            <div>
                <label class="text-gray-500 text-sm">Email</label>

                <p class="text-xl">
                    {{ $user->email }}
                </p>
            </div>

            <div>
                <label class="text-gray-500 text-sm">Role</label>

                <p>

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

                </p>
            </div>

            <div>
                <label class="text-gray-500 text-sm">Status</label>

                <p>

                    @if($user->status == 'Active')
                        <span class="px-3 py-1 rounded-full bg-green-100 text-green-700">
                            Active
                        </span>
                    @else
                        <span class="px-3 py-1 rounded-full bg-red-100 text-red-700">
                            Inactive
                        </span>
                    @endif

                </p>
            </div>

            <div>
                <label class="text-gray-500 text-sm">Created</label>

                <p>
                    {{ $user->created_at->format('d M Y H:i') }}
                </p>
            </div>

            <div>
                <label class="text-gray-500 text-sm">Last Updated</label>

                <p>
                    {{ $user->updated_at->format('d M Y H:i') }}
                </p>
            </div>

        </div>

    </div>

</div>

@endsection