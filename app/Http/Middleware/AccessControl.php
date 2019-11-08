<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;
use Redirect;
use Session;

class AccessControl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if (Auth::guard('admin')->check()) {
            return redirect()->route("admin");
        } else {
            return $next($request);
            //  return redirect()->route("admin.login");
        }
    }
}
