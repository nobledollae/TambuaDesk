@extends('layouts.app')

@section('title', 'Ticket Details')

@section('content')

<div class="max-w-6xl mx-auto">

    @if(session('success'))
        <div class="bg-green-100 border border-green-300 text-green-700 px-5 py-3 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Ticket Details -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow-lg">

            <div class="flex justify-between items-center p-6 border-b">

                <h2 class="text-2xl font-bold">
                    Ticket Details
                </h2>

                <a href="{{ route('tickets.index') }}"
                   class="bg-gray-600 hover:bg-gray-700 text-white px-5 py-2 rounded-lg">
                    ← Back
                </a>

            </div>

            <div class="p-8 space-y-6">

                <div>

                    <span class="text-sm text-gray-500">
                        Ticket Number
                    </span>

                    <h3 class="text-2xl font-bold">
                        {{ $ticket->ticket_number }}
                    </h3>

                </div>

                <div>

                    <span class="text-sm text-gray-500">
                        Title
                    </span>

                    <h2 class="text-xl font-semibold">
                        {{ $ticket->title }}
                    </h2>

                </div>

                <div>

                    <span class="text-sm text-gray-500">
                        Description
                    </span>

                    <div class="mt-2 bg-gray-100 rounded-lg p-4">
                        {{ $ticket->description }}
                    </div>

                </div>

            </div>

        </div>

        <!-- Information Card -->
        <div class="bg-white rounded-xl shadow-lg p-6">

            <h3 class="text-xl font-bold mb-6">
                Ticket Information
            </h3>

            <div class="space-y-5">

                <div>

                    <div class="text-gray-500 text-sm">
                        Status
                    </div>

                    <span class="inline-block mt-1 px-3 py-1 rounded-full bg-blue-100 text-blue-700">
                        {{ $ticket->status }}
                    </span>

                </div>

                <div>

                    <div class="text-gray-500 text-sm">
                        Priority
                    </div>

                    <span class="inline-block mt-1 px-3 py-1 rounded-full bg-red-100 text-red-700">
                        {{ $ticket->priority }}
                    </span>

                </div>

                <div>

                    <div class="text-gray-500 text-sm">
                        Technician
                    </div>

                    <div class="font-semibold">

                        {{ $ticket->technician->name ?? 'Not Assigned' }}

                    </div>

                </div>

                <div>

                    <div class="text-gray-500 text-sm">
                        Created By
                    </div>

                    <div class="font-semibold">

                        {{ $ticket->creator->name ?? 'Unknown' }}

                    </div>

                </div>

                <div>

                    <div class="text-gray-500 text-sm">
                        Created
                    </div>

                    {{ $ticket->created_at->format('d M Y H:i') }}

                </div>

                <div>

                    <div class="text-gray-500 text-sm">
                        Updated
                    </div>

                    {{ $ticket->updated_at->format('d M Y H:i') }}

                </div>

            </div>

        </div>

    </div>

    <!-- Comments -->

    <div class="bg-white rounded-xl shadow-lg mt-8">

        <div class="border-b px-6 py-4">

            <h2 class="text-2xl font-bold">
                Discussion
            </h2>

        </div>

        <div class="p-6">

            @forelse($ticket->comments as $comment)

                <div class="flex space-x-4 mb-6">

                    <div class="w-12 h-12 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold">

                        {{ strtoupper(substr($comment->user->name,0,1)) }}

                    </div>

                    <div class="flex-1">

                        <div class="flex justify-between">

                            <div class="font-semibold">

                                {{ $comment->user->name }}

                            </div>

                            <div class="text-sm text-gray-500">

                                {{ $comment->created_at->diffForHumans() }}

                            </div>

                        </div>

                        <div class="mt-2 bg-gray-100 rounded-lg p-4">

                            {{ $comment->comment }}

                        </div>

                    </div>

                </div>

            @empty

                <div class="text-center text-gray-500 py-8">

                    No comments yet.

                </div>

            @endforelse

        </div>

    </div>

    <!-- Add Comment -->

    <div class="bg-white rounded-xl shadow-lg mt-8">

        <div class="border-b px-6 py-4">

            <h2 class="text-2xl font-bold">

                Add Comment

            </h2>

        </div>

        <form action="{{ route('comments.store', $ticket) }}" method="POST" class="p-6">

            @csrf

            <textarea
                name="comment"
                rows="5"
                class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500"
                placeholder="Write your comment here...">{{ old('comment') }}</textarea>

            @error('comment')

                <p class="text-red-600 mt-2">

                    {{ $message }}

                </p>

            @enderror

            <div class="mt-5 text-right">

                <button
                    type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-semibold">

                    Post Comment

                </button>

            </div>

        </form>

    </div>

</div>

{{-- ===========================
    ATTACHMENTS
=========================== --}}

<div class="bg-white rounded-xl shadow-lg mt-8">

    <div class="border-b px-6 py-4 flex justify-between items-center">

        <div>

            <h2 class="text-2xl font-bold">
                Attachments
            </h2>

            <p class="text-gray-500 text-sm mt-1">
                Upload screenshots, PDFs, documents and other supporting files.
            </p>

        </div>

    </div>

    {{-- Upload Area --}}
    <div class="p-6">

        <form
            id="uploadForm"
            action="{{ route('attachments.store',$ticket) }}"
            method="POST"
            enctype="multipart/form-data">

            @csrf

            <label
                id="drop-area"
                for="attachment"
                class="block border-2 border-dashed border-gray-300 rounded-xl p-10 text-center cursor-pointer transition hover:border-blue-500 hover:bg-blue-50">

                <div class="text-6xl">
                    📁
                </div>

                <h3 class="text-xl font-semibold mt-4">

                    Drag & Drop Files Here

                </h3>

                <p class="text-gray-500 mt-2">

                    or click to browse

                </p>

                <p class="text-sm text-gray-400 mt-3">

                    Images • PDF • Word • Excel • ZIP

                </p>

            </label>

            <input
                type="file"
                id="attachment"
                name="attachment"
                class="hidden">

            <div
                id="selected-file"
                class="mt-5 text-center text-gray-600 italic">

                No file selected

            </div>

            <div
                id="uploading"
                class="hidden mt-5 text-center text-blue-600 font-semibold">

                Uploading...

            </div>

        </form>

        @error('attachment')

            <div class="mt-4 text-red-600">

                {{ $message }}

            </div>

        @enderror

    </div>

    {{-- Attachment List --}}
    <div class="divide-y">

        @forelse($ticket->attachments as $attachment)

            @php

                $extension = strtolower(pathinfo($attachment->original_name, PATHINFO_EXTENSION));

                $imageExtensions = ['jpg','jpeg','png','gif','webp'];

            @endphp

            <div class="flex justify-between items-center p-6 hover:bg-gray-50 transition">

                <div class="flex items-start gap-5">

                    @if(in_array($extension,$imageExtensions))

                        <img
                            src="{{ asset('storage/'.$attachment->file_path) }}"
                            data-full="{{ asset('storage/'.$attachment->file_path) }}"
                            class="attachment-image w-24 h-24 rounded-lg border object-cover cursor-pointer hover:scale-105 transition">

                    @else

                        <div class="text-5xl">

                            @switch($extension)

                                @case('pdf')
                                    📄
                                    @break

                                @case('doc')
                                @case('docx')
                                    📘
                                    @break

                                @case('xls')
                                @case('xlsx')
                                    📊
                                    @break

                                @case('zip')
                                    📦
                                    @break

                                @default
                                    📁

                            @endswitch

                        </div>

                    @endif

                    <div>

                        <div class="font-semibold text-lg">

                            {{ $attachment->original_name }}

                        </div>

                        <div class="text-gray-500 text-sm mt-2">

                            {{ strtoupper($extension) }}

                            •

                            {{ number_format($attachment->file_size/1024,2) }} KB

                        </div>

                        <div class="text-gray-400 text-sm mt-1">

                            Uploaded by

                            <strong>{{ $attachment->user->name }}</strong>

                            •

                            {{ $attachment->created_at->diffForHumans() }}

                        </div>

                    </div>

                </div>

                <div class="flex gap-3">

                    <a
                        href="{{ route('attachments.download',$attachment) }}"
                        class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">

                        Download

                    </a>

                    @if(auth()->user()->role=='admin' || auth()->id()==$attachment->user_id)

                        <form
                            action="{{ route('attachments.destroy',$attachment) }}"
                            method="POST"
                            onsubmit="return confirm('Delete this attachment?')">

                            @csrf
                            @method('DELETE')

                            <button
                                class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg">

                                Delete

                            </button>

                        </form>

                    @endif

                </div>

            </div>

        @empty

            <div class="text-center py-10 text-gray-500">

                No attachments uploaded yet.

            </div>

        @endforelse

    </div>

</div>


<!-- =====================================
     IMAGE PREVIEW MODAL
====================================== -->

<div
    id="imageModal"
    class="fixed inset-0 bg-black/80 hidden items-center justify-center z-50">

    <div class="relative max-w-6xl max-h-screen p-4">

        <!-- Close Button -->
        <button
            id="closeModal"
            type="button"
            class="absolute -top-12 right-0 text-white text-5xl hover:text-gray-300 transition">

            &times;

        </button>

        <!-- Image -->
        <img
            id="modalImage"
            src=""
            alt="Attachment Preview"
            class="max-h-[90vh] max-w-[90vw] rounded-xl shadow-2xl object-contain transition duration-300">

    </div>

</div>

<!-- Activity Timeline -->

<div class="bg-white rounded-xl shadow-lg mt-8">

    <div class="border-b px-6 py-4">

        <h2 class="text-2xl font-bold">
            Activity Timeline
        </h2>

    </div>

    <div class="p-6">

        @forelse($activities as $activity)

            <div class="flex items-start space-x-4 mb-6">

                <div class="w-10 h-10 rounded-full bg-indigo-600 text-white flex items-center justify-center font-bold">

                    {{ strtoupper(substr($activity->user->name ?? 'S', 0, 1)) }}

                </div>

                <div class="flex-1">

                    <div class="flex justify-between">

                        <div>

                            <span class="font-semibold">

                                {{ $activity->user->name ?? 'System' }}

                            </span>

                            <span class="text-gray-600">

                                {{ $activity->action }}

                            </span>

                        </div>

                        <div class="text-sm text-gray-500">

                            {{ $activity->created_at->diffForHumans() }}

                        </div>

                    </div>

                </div>

            </div>

        @empty

            <div class="text-center text-gray-500 py-6">

                No activity recorded for this ticket.

            </div>

        @endforelse

    </div>

</div>


<script>

document.addEventListener('DOMContentLoaded', function () {

    const uploadForm = document.getElementById('uploadForm');
    const fileInput = document.getElementById('attachment');
    const dropArea = document.getElementById('drop-area');
    const selectedFile = document.getElementById('selected-file');
    const uploading = document.getElementById('uploading');

    // ==========================
    // AUTO UPLOAD
    // ==========================

    function uploadFile(file){

        if(!file) return;

        selectedFile.innerHTML =
            "<strong>Selected:</strong> " +
            file.name +
            " (" +
            Math.round(file.size / 1024) +
            " KB)";

        uploading.classList.remove('hidden');

        setTimeout(function(){

            uploadForm.submit();

        },500);

    }

    // ==========================
    // FILE SELECT
    // ==========================

    fileInput.addEventListener('change', function(){

        if(this.files.length){

            uploadFile(this.files[0]);

        }

    });

    // ==========================
    // DRAG OVER
    // ==========================

    dropArea.addEventListener('dragover', function(e){

        e.preventDefault();

        this.classList.add(
            'border-blue-600',
            'bg-blue-50'
        );

    });

    // ==========================
    // DRAG LEAVE
    // ==========================

    dropArea.addEventListener('dragleave', function(){

        this.classList.remove(
            'border-blue-600',
            'bg-blue-50'
        );

    });

    // ==========================
    // DROP
    // ==========================

    dropArea.addEventListener('drop', function(e){

        e.preventDefault();

        this.classList.remove(
            'border-blue-600',
            'bg-blue-50'
        );

        const files = e.dataTransfer.files;

        if(files.length){

            fileInput.files = files;

            uploadFile(files[0]);

        }

    });

    // ==========================
    // IMAGE PREVIEW MODAL
    // ==========================

    const modal = document.getElementById('imageModal');
    const modalImage = document.getElementById('modalImage');
    const closeModal = document.getElementById('closeModal');

    document.querySelectorAll('.attachment-image').forEach(function(image){

        image.addEventListener('click', function(){

            modalImage.src = this.dataset.full;

            modal.classList.remove('hidden');

            modal.classList.add('flex');

        });

    });

    function hideModal(){

        modal.classList.add('hidden');

        modal.classList.remove('flex');

        modalImage.src = "";

    }

    closeModal.addEventListener('click', hideModal);

    modal.addEventListener('click', function(e){

        if(e.target === modal){

            hideModal();

        }

    });

    document.addEventListener('keydown', function(e){

        if(e.key === 'Escape'){

            hideModal();

        }

    });

});

</script>

@endsection