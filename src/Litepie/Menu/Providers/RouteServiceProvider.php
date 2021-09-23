<?php

namespace Litepie\Menu\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Request;
use Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'Litepie\Menu\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param \Illuminate\Routing\Router $router
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        if (Request::is('*admin/menu/menu/*')) {
            Route::bind('menu', function ($menu) {
                $menuRepo = $this->app->make('Litepie\Menu\Interfaces\MenuRepositoryInterface');

                return $menuRepo->findorNew($menu);
            });
        }

        if (Request::is('*admin/menu/submenu/*')) {
            Route::bind('submenu', function ($submenu) {
                $menuRepo = $this->app->make('Litepie\Menu\Interfaces\MenuRepositoryInterface');

                return $menuRepo->findorNew($submenu);
            });
        }
    }

    /**
     * Define the routes for the package.
     *
     * @return void
     */
    public function map()
    {
        $this->mapWebRoutes();
        // $this->mapApiRoutes();
    }

    /**
     * Define the "web" routes for the package.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::group([
            'middleware' => 'web',
            'namespace'  => $this->namespace,
        ], function ($router) {
            require __DIR__.'/../routes/web.php';
        });
    }

    /**
     * Define the "web" routes for the package.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::group([
            'middleware' => 'api',
            'namespace'  => $this->namespace,
        ], function ($router) {
            require __DIR__.'/../routes/api.php';
        });
    }
}
