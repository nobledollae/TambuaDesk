@extends('layouts.app')

@section('title', 'Create User')

@section('content')

<div class="max-w-3xl mx-auto">

    <div class="bg-white rounded-xl shadow-lg">

        <div class="flex justify-between items-center p-6 border-b">

            <h2 class="text-2xl font-bold">
                Create User
            </h2>

            <a href="{{ route('users.index') }}"
               class="bg-gray-600 hover:bg-gray-700 text-white px-5 py-2 rounded-lg">
                ← Back
            </a>

        </div>

        <form action="{{ route('users.store') }}" method="POST" class="p-8">

            @csrf

            <div class="mb-6">

                <label class="block font-semibold mb-2">
                    Full Name
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    class="w-full border rounded-lg px-4 py-3">

                @error('name')
                    <p class="text-red-600 mt-2">{{ $message }}</p>
                @enderror

            </div>

            <div class="mb-6">

                <label class="block font-semibold mb-2">
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    class="w-full border rounded-lg px-4 py-3">

                @error('email')
                    <p class="text-red-600 mt-2">{{ $message }}</p>
                @enderror

            </div>

            <div class="grid grid-cols-2 gap-6">

                <div>

                    <label class="block font-semibold mb-2">
                        Role
                    </label>

                    <select
                        name="role"
                        class="w-full border rounded-lg px-4 py-3">

                        <option value="employee">Employee</option>
                        <option value="technician">Technician</option>
                        <option value="admin">Administrator</option>

                    </select>

                </div>

                <div>

                    <label class="block font-semibold mb-2">
                        Status
                    </label>

                    <select
                        name="status"
                        class="w-full border rounded-lg px-4 py-3">

                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>

                    </select>

                </div>

            </div>

            <div class="grid grid-cols-2 gap-6 mt-6">

                <div>

                    <label class="block font-semibold mb-2">
                        Password
                    </label>

                    <input
                        type="password"
                        name="password"
                        class="w-full border rounded-lg px-4 py-3">

                </div>

                <div>

                    <label class="block font-semibold mb-2">
                        Confirm Password
                    </label>

                    <input
                        type="password"
                        name="password_confirmation"
                        class="w-full border rounded-lg px-4 py-3">

                </div>

            </div>

            <div class="mt-8 flex justify-end">

                <button
                    class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-semibold">

                    Create User

                </button>

            </div>

        </form>

    </div>

</div>

@endsection