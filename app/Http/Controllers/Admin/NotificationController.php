<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notifications;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $notifications = Notifications::latest()->paginate(20);
        $unreadCount   = Notifications::whereNull('read_at')->count();

        return view('admin.pages.notifications.index', compact('notifications', 'unreadCount'));
    }

    public function getNotifications(): JsonResponse
    {
        $notifications = Notifications::whereNull('read_at')
            ->latest()
            ->take(10)
            ->get(['id', 'title', 'message', 'read_at', 'created_at']);

        $unreadNotificationsCount = Notifications::whereNull('read_at')->count();

        return response()->json([
            'notifications'            => $notifications,
            'unreadNotificationsCount' => $unreadNotificationsCount,
        ]);
    }

    public function markAsRead($id)
    {
        $notification = Notifications::findOrFail($id);
        $notification->markAsRead();

        return view('admin.pages.notifications.show', compact('notification'));
    }
}
