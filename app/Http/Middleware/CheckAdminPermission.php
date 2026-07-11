<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAdminPermission
{
    public function handle($request, Closure $next, $permission)
    {
        if (!Auth::guard('admin')->check() || !Auth::guard('admin')->user()->hasPermission($permission)) {
            abort(403, 'You do not have permission to access this section.');
        }

        return $next($request);
    }
}