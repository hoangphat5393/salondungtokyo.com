<?php

namespace AppHttpMiddleware;

use Closure;
use IlluminateHttpRequest;
use IlluminateSupportFacadesAuth;

class CustomCKFinderAuth
{
    /**
     * CKFinder connector auth: only authenticated admin users may upload/browse.
     *
     * @param  Request  $request
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'admin')
    {
        config(['ckfinder.authentication' => function () use ($guard) {
            return Auth::guard($guard)->check() || Auth::guard('web')->check() || Auth::check();
        }]);

        return $next($request);
    }
}
