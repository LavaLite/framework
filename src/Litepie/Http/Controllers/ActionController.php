<?php

namespace Litepie\Http\Controllers;

use Litepie\Http\Response\ActionResponse;
use Litepie\Theme\ThemeAndViews;
use Litepie\User\Traits\RoutesAndGuards;

class ActionController extends Controller
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
        $this->middleware('auth')->except(['get', 'post']);
        $this->middleware('localize.route');
        $this->middleware(function ($request, $next) {
            $this->response = app(ActionResponse::class);
            $this->layout = 'app';
            $this->setTheme();
            return $next($request);
        });
    }

}
