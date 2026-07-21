<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Closure;

class AdminPermission
{
    public function handle($request, Closure $next, $ability)
    {
        $admin = Auth::guard('admin')->user();

        if (!$admin || Gate::forUser($admin)->denies($ability)) {
            abort(403);
        }

        return $next($request);
    }
}
