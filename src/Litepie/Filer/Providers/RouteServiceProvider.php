<?php

namespace Litepie\Filer\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
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
    protected $namespace = 'Litepie\Filer\Http\Controllers';

    /**
     * Define the routes for the application.
     *
     * @param \Illuminate\Routing\Router $router
     *
     * @return void
     */
    public function map()
    {
        Route::group([
            'middleware' => 'web',
            'namespace'  => $this->namespace,
        ], function () {
            require __DIR__.'/../routes/web.php';
        });

        Route::group([
            'middleware' => 'api',
            'namespace'  => $this->namespace,
        ], function () {
            require __DIR__.'/../routes/api.php';
        });
    }
}
