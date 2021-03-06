<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle($request, Closure $next, $guard = null)
    {
        if ($guard == "admin" && Auth::guard($guard)->check()) {
            return redirect('admin/dashboard');
        }

        if ($guard == "toiletowner" && Auth::guard($guard)->check()) {
            return redirect('toiletowner/dashboard');
        }

        if ($guard == "capturer" && Auth::guard($guard)->check()) {
            return redirect('capturers/dashboard');
        }

        if (Auth::guard($guard)->check()) {
            return redirect('/home');
        }
        
        return $next($request);
    }
}
