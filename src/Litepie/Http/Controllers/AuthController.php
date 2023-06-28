<?php

namespace Litepie\Http\Controllers;

use Litepie\Theme\ThemeAndViews;
use Litepie\User\Traits\RoutesAndGuards;

class AuthController extends Controller
{
    use RoutesAndGuards;
    use ThemeAndViews;

    /**
     * Initialize public controller.
     *
     * @return null
     */
    public function __construct()
    {
        $this->middleware('set.guard');
        $this->middleware('auth');
        $this->middleware('localize.route');
        $this->middleware(function ($request, $next) {
            $this->response = app(ResourceResponse::class);
            $this->layout = 'app';
            $this->setTheme();
            return $next($request);
        });
    }
}
