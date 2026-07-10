@extends('layouts.app')

@section('title', 'Edit User')

@section('content')

<div class="max-w-3xl mx-auto">

    <div class="bg-white rounded-xl shadow-lg">

        <div class="flex justify-between items-center p-6 border-b">

            <h2 class="text-2xl font-bold">
                Edit User
            </h2>

            <a href="{{ route('users.index') }}"
               class="bg-gray-600 hover:bg-gray-700 text-white px-5 py-2 rounded-lg">
                ← Back
            </a>

        </div>

        <form action="{{ route('users.update',$user) }}"
              method="POST"
              class="p-8">

            @csrf
            @method('PUT')

            <div class="mb-6">

                <label class="block font-semibold mb-2">
                    Full Name
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name',$user->name) }}"
                    class="w-full border rounded-lg px-4 py-3">

            </div>

            <div class="mb-6">

                <label class="block font-semibold mb-2">
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email',$user->email) }}"
                    class="w-full border rounded-lg px-4 py-3">

            </div>

            <div class="grid grid-cols-2 gap-6">

                <div>

                    <label class="block font-semibold mb-2">
                        Role
                    </label>

                    <select
                        name="role"
                        class="w-full border rounded-lg px-4 py-3">

                        <option value="employee"
                            {{ $user->role=='employee'?'selected':'' }}>
                            Employee
                        </option>

                        <option value="technician"
                            {{ $user->role=='technician'?'selected':'' }}>
                            Technician
                        </option>

                        <option value="admin"
                            {{ $user->role=='admin'?'selected':'' }}>
                            Administrator
                        </option>

                    </select>

                </div>

                <div>

                    <label class="block font-semibold mb-2">
                        Status
                    </label>

                    <select
                        name="status"
                        class="w-full border rounded-lg px-4 py-3">

                        <option value="Active"
                            {{ $user->status=='Active'?'selected':'' }}>
                            Active
                        </option>

                        <option value="Inactive"
                            {{ $user->status=='Inactive'?'selected':'' }}>
                            Inactive
                        </option>

                    </select>

                </div>

            </div>

            <div class="mt-8 flex justify-end">

                <button
                    type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-semibold">

                    Update User

                </button>

            </div>

        </form>

    </div>

</div>

@endsection