<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notificationsIndex = Auth::user()->notifications; 
        return view('user.notifications.index', compact('notificationsIndex'));
    }

    public function markAsRead($id)
    {
        $notification = Auth::user()->notifications()->findOrFail($id);
        $notification->markAsRead();
        return view('user.notifications.show', compact('notification'));
    }

    public function show($id)
    {
        $notification = Auth::user()->notifications()->findOrFail($id);
        $notification->markAsRead();
        return view('user.notifications.show', compact('notification'));
    }
} 
