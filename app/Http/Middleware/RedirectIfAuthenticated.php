<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;
    
        foreach ($guards as $guard) {
            // admin
            if ($guard == 'admin' && Auth::guard($guard)->check()) {
                // check if admin autorized, then redirect to '/admin/';
                return redirect(RouteServiceProvider::ADMIN);
            }

            // web
            if (Auth::guard($guard)->check()) {
                return redirect(RouteServiceProvider::HOME);  
            } 
        }

        return $next($request);
    }
}
