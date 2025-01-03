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
            if (Auth::check()) {
                $user = Auth::user();
                $notificationCount = $user->unreadNotifications->count();
                $view->with('notificationCount', $notificationCount);
            } else {
                $view->with('notificationCount', 0);
            }
        });

        View::composer('*', function ($view) {
            if (Auth::check()) {
                $notifications = Auth::user()->unreadNotifications;
                
                $view->with('notifications', $notifications);
            }
        });
        
    }
}
