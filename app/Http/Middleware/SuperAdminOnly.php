<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class SuperAdminOnly
{
    public function handle($request, Closure $next)
    {
        if (!Auth::guard('admin')->user()->isSuperAdmin()) {
            abort(403);
        }

        return $next($request);
    }
}
