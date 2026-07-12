<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Models\Notifications;  // Use your custom model

class AppServiceProvider extends ServiceProvider
{ 
    /**
     * Register any application services.
     *
     * @return void 
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            $notificationCount = 0;
            $notifications = collect();

            if (Auth::check()) {
                $userId = Auth::id();
                $notificationCount = Notifications::forUser($userId)->unread()->count();
                $notifications = Notifications::forUser($userId)->unread()->latest()->take(5)->get();
            } elseif (Auth::guard('agent')->check()) {
                $userId = Auth::guard('agent')->id();
                $notificationCount = Notifications::forUser($userId)->unread()->count();
                $notifications = Notifications::forUser($userId)->unread()->latest()->take(5)->get();
            }

            $view->with([
                'notificationCount' => $notificationCount,
                'notifications' => $notifications,
            ]);
        });
    }
}