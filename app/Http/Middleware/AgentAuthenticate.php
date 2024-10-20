<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Closure;


class AgentAuthenticate
{
    public function handle($request, Closure $next)
    {
        if (Auth::guard('agent')->check()) {
            return $next($request);
        }

        return redirect()->route('agent.login');
    } 
} 
