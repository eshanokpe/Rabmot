<?php

namespace App\Http\Controllers\Agent;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $userAgent = Auth::guard('agent')->user();

        $notificationsIndex = $userAgent->notifications; 
        return view('agent.notifications.index', compact('notificationsIndex'));
    }

    public function markAsRead($id)
    {
        $userAgent = Auth::guard('agent')->user();
        $notification = $userAgent->notifications()->findOrFail($id);
        $notification->markAsRead();
        return view('agent.notifications.show', compact('notification'));
    }

    public function show($id)
    {
        $userAgent = Auth::guard('agent')->user();
        $notification = $userAgent->notifications()->findOrFail($id);
        $notification->markAsRead();
        return view('agent.notifications.show', compact('notification'));
    }
} 
