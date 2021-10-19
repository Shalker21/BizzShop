<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Arr;

class Authenticate extends Middleware
{
    protected $guards;

    // I didn't know how to get guards so I just used this method
    public function handle($request, Closure $next, ...$guards) {
        $this->guards = $guards;

        return parent::handle($request, $next, ...$guards);
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            if (Arr::first($this->guards) === 'admin') {
                return route('admin.login');
            }

            return route('login');
        }
    }
}
