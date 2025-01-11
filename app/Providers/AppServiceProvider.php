<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Models\Notification;
use App\Models\User;

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
                // Default guard (web)
                $user = Auth::user();
                $notificationCount = $user->unreadNotifications->count();
                $notifications = $user->unreadNotifications;
            } elseif (Auth::guard('agent')->check()) {
                // Agent guard
                $user = Auth::guard('agent')->user();
                $notificationCount = $user->unreadNotifications->count();
                $notifications = $user->unreadNotifications;
            }
            $view->with([
                'notificationCount' => $notificationCount,
                'notifications' => $notifications,
            ]);

        });

        
    }
}
