<?php

namespace Litepie\Trans\Middleware;

use Closure;
use Illuminate\Contracts\Routing\Middleware;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TransRedirectFilter implements Middleware
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
        $currentTrans = app('locale')->getCurrentTrans();
        $defaultTrans = app('locale')->getDefaultTrans();
        $params = explode('/', $request->path());

        if (count($params) > 0) {
            $localeCode = $params[ 0 ];
            $locales = app('locale')->getSupportedTrans();
            $hideDefaultTrans = app('locale')->hideDefaultTransInURL();
            $redirection = false;

            if (!empty($locales[ $localeCode ])) {
                if ($localeCode === $defaultTrans && $hideDefaultTrans) {
                    $redirection = app('locale')->getNonLocalizedURL();
                }
            } elseif ($currentTrans !== $defaultTrans || !$hideDefaultTrans) {
                // If the current url does not contain any locale
                // The system redirect the user to the very same url "localized"
                // we use the current locale to redirect him
                $redirection = app('locale')->getLocalizedURL();
            }

            if ($redirection) {
                // Save any flashed data for redirect
                app('session')->reflash();

                return new RedirectResponse($redirection, 301, ['Vary' => 'Accept-Language']);
            }
        }

        return $next($request);
    }
}
