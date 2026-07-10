@extends('layouts.app')

@section('title','Access Denied')

@section('content')

<div class="max-w-xl mx-auto text-center py-20">

    <h1 class="text-6xl font-bold text-red-600">
        403
    </h1>

    <h2 class="text-3xl font-bold mt-6">
        Access Denied
    </h2>

    <p class="mt-4 text-gray-600">
        You don't have permission to access this page.
    </p>

    <a href="{{ route('dashboard') }}"
       class="inline-block mt-8 bg-blue-600 text-white px-6 py-3 rounded-lg">

        Return to Dashboard

    </a>

</div>

@endsection