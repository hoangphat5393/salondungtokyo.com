<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;

class CustomCKFinderAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'admin')
    {
        if (Auth::guard($guard)->guest()) {
            config(['ckfinder.authentication' => function () {
                return true;
            }]);
        } else {
            config(['ckfinder.authentication' => function () {
                return false;
            }]);
        }

        return $next($request);
    }
}
