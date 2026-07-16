<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Display all notifications.
     */
    public function index()
    {
        $notifications = Auth::user()
            ->notifications()
            ->latest()
            ->paginate(15);

        return view('notifications.index', compact('notifications'));
    }

    /**
     * Mark a single notification as read.
     */
    public function markAsRead($id)
    {
        $notification = Auth::user()
            ->notifications()
            ->where('id', $id)
            ->firstOrFail();

        if (is_null($notification->read_at)) {
            $notification->markAsRead();
        }

        if (isset($notification->data['ticket_id'])) {
            return redirect()
                ->route('tickets.show', $notification->data['ticket_id']);
        }

        return back();
    }

    /**
     * Mark all notifications as read.
     */
    public function markAllAsRead()
    {
        Auth::user()
            ->unreadNotifications
            ->markAsRead();

        return back()->with('success', 'All notifications marked as read.');
    }

    /**
     * Return latest notifications as JSON.
     */
    public function latest()
    {
        $notifications = Auth::user()
            ->notifications()
            ->latest()
            ->take(10)
            ->get();

        return response()->json([
            'unread' => Auth::user()->unreadNotifications()->count(),
            'notifications' => $notifications
        ]);
    }
}