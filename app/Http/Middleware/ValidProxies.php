<?php

namespace App\Http\Middleware;

use Closure;

class ValidProxies
{
    public function handle($request, Closure $next)
    {
        $request->setTrustedProxies([ $request->getClientIp() ]);
        return $next($request);
    }
}