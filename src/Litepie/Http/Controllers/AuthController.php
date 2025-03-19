<?php

namespace Litepie\Http\Controllers;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Litepie\Http\Response\ResourceResponse;
use Litepie\Theme\ThemeAndViews;
use Litepie\User\Traits\RoutesAndGuards;

class AuthController implements HasMiddleware
{
    use RoutesAndGuards;
    use ThemeAndViews;

    /**
     * @var store response object
     */
    public static $response;

    /**
     * Get the middleware that should be assigned to the controller.
     */
    public static function middleware(): array
    {
        return [
            new Middleware('set.guard'),
            new Middleware('localize.route'),
            function (Request $request, Closure $next) {
                self::$response = app(ResourceResponse::class);
                self::$layout = 'app';
                self::setTheme();

                return $next($request);
            },
        ];
    }
}
