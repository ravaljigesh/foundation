<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'admins')
    {
        //Below code will check if user is logged in ?
        if (!Auth::guard($guard)->check()) {
            return redirect('/authority/login');
        }
        return $next($request);
    }
}
