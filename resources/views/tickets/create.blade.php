@extends('layouts.app')

@section('title', 'Create Ticket')

@section('content')

<div class="max-w-3xl mx-auto">

    <div class="bg-white rounded-xl shadow-lg">

        <div class="flex justify-between items-center border-b p-6">

            <h2 class="text-2xl font-bold">
                Create IT Support Ticket
            </h2>

            <a href="{{ url()->previous() != url()->current() ? url()->previous() : route('dashboard') }}"
               class="bg-gray-600 hover:bg-gray-700 text-white px-5 py-2 rounded-lg font-semibold">

                ← Back

            </a>

        </div>

        <div class="p-6">

            @if(session('success'))

                <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-lg mb-6">

                    {{ session('success') }}

                </div>

            @endif

            <form action="{{ route('tickets.store') }}" method="POST">

                @csrf

                <div class="mb-5">

                    <label class="block font-semibold mb-2">
                        Ticket Title
                    </label>

                    <input
                        type="text"
                        name="title"
                        value="{{ old('title') }}"
                        class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">

                    @error('title')

                        <p class="text-red-600 mt-2">

                            {{ $message }}

                        </p>

                    @enderror

                </div>

                <div class="mb-5">

                    <label class="block font-semibold mb-2">
                        Description
                    </label>

                    <textarea
                        name="description"
                        rows="6"
                        class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">{{ old('description') }}</textarea>

                    @error('description')

                        <p class="text-red-600 mt-2">

                            {{ $message }}

                        </p>

                    @enderror

                </div>

                <div class="mb-6">

                    <label class="block font-semibold mb-2">
                        Priority
                    </label>

                    <select
                        name="priority"
                        class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">

                        <option value="">-- Select Priority --</option>

                        <option value="Low" {{ old('priority') == 'Low' ? 'selected' : '' }}>
                            Low
                        </option>

                        <option value="Medium" {{ old('priority') == 'Medium' ? 'selected' : '' }}>
                            Medium
                        </option>

                        <option value="High" {{ old('priority') == 'High' ? 'selected' : '' }}>
                            High
                        </option>

                        <option value="Critical" {{ old('priority') == 'Critical' ? 'selected' : '' }}>
                            Critical
                        </option>

                    </select>

                    @error('priority')

                        <p class="text-red-600 mt-2">

                            {{ $message }}

                        </p>

                    @enderror

                </div>

                <div class="flex justify-end gap-3">

                    <a href="{{ url()->previous() != url()->current() ? url()->previous() : route('dashboard') }}"
                       class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg">

                        Cancel

                    </a>

                    <button
                        type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-semibold">

                        Submit Ticket

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection