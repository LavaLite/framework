<?php

namespace Litepie\Trans\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Mcamara\LaravelLocalization\Middleware\LaravelLocalizationMiddlewareBase;

class LocalizeViewPath extends LaravelLocalizationMiddlewareBase
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

        // If the URL of the request is in exceptions.
        if ($this->shouldIgnore($request)) {
            return $next($request);
        }

        $app = app();

        $currentLocale = app('LocalizeRoutes')->getCurrentLocale();
        $viewPath = resource_path('views/'.$currentLocale);

        // Add current locale-code to view-paths
        View::addLocation($viewPath);

        return $next($request);
    }
}
