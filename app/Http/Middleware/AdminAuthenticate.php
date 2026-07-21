<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Closure;


class AdminAuthenticate
{
    public function handle($request, Closure $next)
    {
        if (Auth::guard('admin')->check()) {
            $admin = Auth::guard('admin')->user();

            if (!$admin->isActive()) {
                Auth::guard('admin')->logout();
                return redirect()->route('admin.login')->withErrors(['error' => 'Your admin account has been deactivated.']);
            }

            return $next($request);
        }

        return redirect()->route('admin.login');
    }
}
