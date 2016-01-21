<?php

namespace Litepie\Trans\Middleware;

use Closure;
use Illuminate\Contracts\Routing\Middleware;
use Illuminate\Http\RedirectResponse;

class TransSessionRedirect implements Middleware
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
        $params = explode('/', $request->path());

        if (count($params) > 0 && $locale = app('locale')->checkTransInSupportedTrans($params[ 0 ])) {
            session(['locale' => $params[ 0 ]]);

            return $next($request);
        }

        $locale = session('locale', false);

        if ($locale && app('locale')->checkTransInSupportedTrans($locale) && !(app('locale')->getDefaultTrans() === $locale && app('locale')->hideDefaultTransInURL())) {
            app('session')->reflash();
            $redirection = app('locale')->getLocalizedURL($locale);

            return new RedirectResponse($redirection, 302, ['Vary' => 'Accept-Language']);
        }

        return $next($request);
    }
}
