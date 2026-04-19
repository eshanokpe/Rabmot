<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Notifications;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * List all notifications for the authenticated user (newest first).
     */
    public function index(Request $request): View
    {
        $userId = Auth::id();
    
        // Start query
        $query = Notifications::forUser($userId)->with('vehicle');
        
        // Apply filters
        if ($request->filter === 'unread') {
            $query->unread();
        } elseif ($request->filter === 'vehicle') {
            $query->where('type', 'vehicle_expiry');
        }
        
        // Get notifications with pagination
        $notificationsIndex = $query->latest()->paginate(20);
        
        // Get unread count
        $unreadCount = Notifications::forUser($userId)->unread()->count();

        return view('user.notifications.index', compact('notificationsIndex', 'unreadCount'));
    } 

    /**
     * Show a single notification and mark it as read.
     */
    public function show( $id): View
    {
        $decryptedId = decrypt($id);
        $notification = Notifications::forUser(Auth::id())->findOrFail($decryptedId);
        $notification->markAsRead();

        return view('user.notifications.show', compact('notification'));
    }

    /**
     * Mark a single notification as read (AJAX-friendly).
     */
    public function markAsRead( $id): View
    {
        $decryptedId = decrypt($id);
        $notification = Notifications::forUser(Auth::id())->findOrFail($decryptedId);
        $notification->markAsRead();
        return view('user.notifications.show', compact('notification'));
    }

    /**
     * Mark ALL unread notifications as read (AJAX-friendly).
     */
    public function markAllAsRead(): JsonResponse
    {
        Notifications::forUser(Auth::id())
            ->unread()
            ->update(['read_at' => now()]);

        return response()->json(['success' => true, 'message' => 'All notifications marked as read.']);
    }

    /**
     * Delete a notification.
     */
    public function destroy( $id): JsonResponse
    {
        $notification = Notifications::forUser(Auth::id())->findOrFail($id);
        $notification->delete();

        return response()->json(['success' => true, 'message' => 'Notification deleted.']);
    }

    /**
     * Return unread notification count (for navbar badge polling).
     */
    public function unreadCount(): JsonResponse
    {
        $count = Notifications::forUser(Auth::id())->unread()->count();

        return response()->json(['count' => $count]);
    }
}