@extends('layouts.app')

@section('title','My Profile')

@section('content')
<div class="flex items-center justify-between mb-8">

    <div>

        <h1 class="text-3xl font-bold">
            My Account
        </h1>

        <p class="text-gray-500">
            Manage your account settings.
        </p>

    </div>

    <a
        href="{{ url()->previous() != url()->current()
        ? url()->previous()
        : route('dashboard') }}"
        class="bg-gray-200 hover:bg-gray-300 px-5 py-2 rounded-lg">

        ← Back

    </a>

</div>
<div class="max-w-5xl mx-auto space-y-8">

    <div class="bg-white rounded-xl shadow p-6">
        <h1 class="text-3xl font-bold">My Profile</h1>
        <p class="text-gray-500 mt-2">Manage your account information and security.</p>
    </div>

    @if(session('status'))
    <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded">
        {{ session('status') }}
    </div>
    @endif

    <div class="bg-white rounded-xl shadow p-6">
        <h2 class="text-xl font-bold mb-6">Profile Information</h2>

       <form
    method="POST"
    action="{{ route('profile.update') }}"
    enctype="multipart/form-data">

    @csrf
    @method('PATCH')

    <div class="flex flex-col items-center mb-8">

    <img
        src="{{ $user->profile_photo_url }}"
        class="w-40 h-40 rounded-full object-cover border-4 border-blue-600 shadow-lg">

    <label class="mt-5 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg cursor-pointer">

        Change Photo

        <input
            type="file"
            name="profile_photo"
            class="hidden">

    </label>

    <div class="mt-6 text-center">

    <h2 class="text-2xl font-bold">
        {{ $user->name }}
    </h2>

    <p class="text-gray-500">
        {{ $user->email }}
    </p>

    <div class="mt-4 inline-block bg-blue-100 text-blue-700 px-4 py-1 rounded-full font-semibold">

        {{ strtoupper($user->role) }}

    </div>

    <div class="mt-4 text-gray-600">

        <strong>Member Since:</strong>

        {{ $user->created_at->format('F Y') }}

    </div>

    <div class="text-gray-600">

        <strong>Last Login:</strong>

        {{ $user->last_login_at
            ? $user->last_login_at->diffForHumans()
            : 'First Login'
        }}

    </div>

</div>

    @error('profile_photo')

        <div class="text-red-600 mt-2">

            {{ $message }}

        </div>

    @enderror

</div>

            <div class="mb-5">
                <label class="block font-semibold mb-2">Full Name</label>
                <input
                    type="text"
                    name="name"
                    value="{{ old('name',$user->name) }}"
                    class="w-full border rounded-lg px-4 py-3">
                @error('name')
                <p class="text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-5">
                <label class="block font-semibold mb-2">Email Address</label>
                <input
                    type="email"
                    name="email"
                    value="{{ old('email',$user->email) }}"
                    class="w-full border rounded-lg px-4 py-3">
                @error('email')
                <p class="text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg">
                Save Changes
            </button>
        </form>
    </div>

    <div class="bg-white rounded-xl shadow p-6">
        <h2 class="text-xl font-bold mb-6">Change Password</h2>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            @method('PUT')

            <div class="mb-5">
                <label class="block font-semibold mb-2">Current Password</label>
                <input type="password" name="current_password" class="w-full border rounded-lg px-4 py-3">
                @error('current_password','updatePassword')
                <p class="text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-5">
                <label class="block font-semibold mb-2">New Password</label>
                <input type="password" name="password" class="w-full border rounded-lg px-4 py-3">
                @error('password','updatePassword')
                <p class="text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-5">
                <label class="block font-semibold mb-2">Confirm Password</label>
                <input type="password" name="password_confirmation" class="w-full border rounded-lg px-4 py-3">
            </div>

            <button class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg">
                Update Password
            </button>
        </form>
    </div>

    <div class="bg-white rounded-xl shadow border border-red-200 p-6">
        <h2 class="text-xl font-bold text-red-600 mb-3">Danger Zone</h2>

        <p class="text-gray-600 mb-5">
            Deleting your account is permanent and cannot be undone.
        </p>

        <form method="POST"
              action="{{ route('profile.destroy') }}"
              onsubmit="return confirm('Are you sure you want to permanently delete your account?');">
            @csrf
            @method('DELETE')

            <label class="block font-semibold mb-2">
                Enter your password to continue
            </label>

            <input
                type="password"
                name="password"
                class="w-full border rounded-lg px-4 py-3 mb-4">

            @error('password','userDeletion')
            <p class="text-red-600 mb-4">{{ $message }}</p>
            @enderror

            <button class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg">
                Delete Account
            </button>
        </form>
    </div>

</div>
@endsection
