<?php

namespace Litepie\User\Providers;

use App\User;
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
    protected $namespace = 'Litepie\User\Http\Controllers';

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

        if (Request::is('*admin/user/user/*')) {
            Route::bind('user', function ($user) {
                $repos = $this->app->make('Litepie\User\Interfaces\UserRepositoryInterface');
                return $repos->findorNew($user);
            });
        }

        if (Request::is('*/user/team/*')) {
            Route::bind('team', function ($team) {
                $teamrepo = $this->app->make('Litepie\User\Interfaces\TeamRepositoryInterface');
                return $teamrepo->findorNew($team);
            });
        }

        if (Request::is('*admin/user/*')) {
            Route::bind('client', function ($client) {
                $repos = $this->app->make('Litepie\User\Interfaces\ClientRepositoryInterface');
                return $repos->findorNew($client);
            });
        }

        if (Request::is('profile/*')) {
            Route::bind('user', function ($user) {
                $repos = $this->app->make('Litepie\User\Interfaces\UserRepositoryInterface');
                return $repos->findorNew($user);
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

        $this->mapApiRoutes();

        //
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
            'namespace' => $this->namespace,
            'middleware' => 'web',
        ], function ($router) {
            require __DIR__ . '/../routes/auth.php';
            require __DIR__ . '/../routes/web.php';
        });
    }

    /**
     * 
     * Define the "api" routes for the package.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::group([
            'middleware' => 'api',
            'namespace'  => $this->namespace,
            'prefix'     => 'api',
        ], function ($router) {
            require (__DIR__ . '/../routes/api.php');
        });
    }

}
