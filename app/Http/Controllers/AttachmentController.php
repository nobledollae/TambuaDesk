<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AttachmentController extends Controller
{
    public function store(Request $request, Ticket $ticket)
    {
        $request->validate([
            'attachment' => 'required|file|max:10240|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx,txt,zip'
        ]);

        $file = $request->file('attachment');

        $storedName = time().'_'.$file->getClientOriginalName();

        $file->storeAs('attachments', $storedName, 'public');

        Attachment::create([
            'ticket_id' => $ticket->id,
            'user_id' => Auth::id(),
            'original_name' => $file->getClientOriginalName(),
            'file_name' => $storedName,
            'file_type' => $file->getClientMimeType(),
            'file_size' => $file->getSize(),
        ]);

        return back()->with('success', 'Attachment uploaded successfully.');
    }

    public function download(Attachment $attachment)
    {
        return Storage::disk('public')
            ->download(
                'attachments/'.$attachment->file_name,
                $attachment->original_name
            );
    }

    public function destroy(Attachment $attachment)
    {
        Storage::disk('public')
            ->delete('attachments/'.$attachment->file_name);

        $attachment->delete();

        return back()->with('success', 'Attachment deleted successfully.');
    }
}