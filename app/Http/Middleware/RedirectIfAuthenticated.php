<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        switch ($guard) {
            case 'admin':
                // code...
                if (Auth::guard($guard)->check()) {
                    return redirect()->route("admin");
                }

                break;
            case 'web':
                // code...
                if (Auth::guard($guard)->check()) {
                    return redirect()->route("home");
                }
                break;
            case 'donor':
                // code...
                if (Auth::guard($guard)->check()) {
                    return redirect()->route("donor");
                }
                break;

            default:
                // code...
                if (Auth::guard($guard)->check()) {
                    return redirect()->route("home");
                }
                break;
        }

        if (Auth::guard($guard)->check()) {
            return redirect('/home');
        }

        return $next($request);
    }
}
