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
            $agent = Auth::guard('agent')->user();

            if ($agent->approval_status !== 'approved') {
                Auth::guard('agent')->logout();
                return redirect()->route('agent.login')->withErrors(['error' => 'Your agent account is not currently approved. Please contact support if you believe this is a mistake.']);
            }

            if ($agent->status !== 'active') {
                Auth::guard('agent')->logout();
                return redirect()->route('agent.login')->withErrors(['error' => 'Your agent account has been suspended. Please contact support.']);
            }

            return $next($request);
        }

        return redirect()->route('agent.login');
    }
} 
