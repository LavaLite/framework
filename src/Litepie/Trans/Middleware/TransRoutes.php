<?php

namespace Litepie\Trans\Middleware;

use Closure;
use Illuminate\Contracts\Routing\Middleware;
use Illuminate\Http\Request;

class TransRoutes implements Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $app = app();

        $routeName = $app[ 'locale' ]->getRouteNameFromAPath($request->getUri());

        $app[ 'locale' ]->setRouteName($routeName);

        return $next($request);
    }
}
