<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;

class RememberEmailMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && !Cookie::has('login_email')) {
            $user = Auth::user();
            Cookie::queue('login_email', $user->email, 60 * 24 * 30); // Remember email for 30 days
        }

        return $next($request);
    }
}
