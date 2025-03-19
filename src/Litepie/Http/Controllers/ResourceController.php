<?php

namespace Litepie\Http\Controllers;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Litepie\Http\Response\ResourceResponse;
use Litepie\Theme\ThemeAndViews;
use Litepie\User\Traits\RoutesAndGuards;

class ResourceController implements HasMiddleware
{
    use RoutesAndGuards;
    use ThemeAndViews;

    /**
     * @var store response object
     */
    public static $response;

    /**
     * @var store form for the module
     */
    public static $form;

    /**
     * @var store other modules in the package
     */
    public static $modules;

    /**
     * Get the middleware that should be assigned to the controller.
     */
    public static function middleware(): array
    {
        return [
            new Middleware('set.guard'),
            new Middleware('auth'),
            new Middleware('localize.route'),
            function (Request $request, Closure $next) {
                self::$response = app(ResourceResponse::class);
                self::$layout = 'app';
                self::setTheme();

                return $next($request);
            },
        ];
    }

    /**
     * Show dashboard for each user.
     *
     * @return \Illuminate\Http\Response
     */
    public function home(Request $request)
    {
        $user = $request->user()->toArray();

        return self::$response->setMetaTitle(__('Dashboard'))
            ->view('user.home')
            ->data(compact('user'))
            ->layout('home')
            ->output();
    }

    /**
     * Prepare the modules for the list.
     *
     * @var array  - Modules
     * @var string - Language  namespace
     *
     * @return array
     */
    public static function modules($modules, $ns, $url = null, $seperator = '::')
    {
        $arr = [];
        $rUrl = request()->fullUrl();
        if (is_array($modules)) {
            foreach ($modules as $key => $module) {
                $arr[$key]['module'] = $module;
                $arr[$key]['name'] = trans("{$ns}{$seperator}{$module}.names");
                $arr[$key]['url'] = $url.'/'.$module;
                $arr[$key]['status'] = strpos($rUrl, $arr[$key]['url']) !== false ? 'active' : '';
                $arr[$key]['icon'] = trans("{$ns}{$seperator}{$module}.icon");
            }
        }

        return $arr;
    }
}
