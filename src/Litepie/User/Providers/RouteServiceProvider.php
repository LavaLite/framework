<?php

namespace Litepie\User\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use App\User;
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
     * @param   \Illuminate\Routing\Router  $router
     * @return void
     */
    public function boot()
    {
        parent::boot();

        if (Request::is('*/user/user/*')) {
            Route::bind('user', function ($user) {
                $userrepo = $this->app->make('\Litepie\User\Interfaces\UserRepositoryInterface');
                return $userrepo->findorNew($user);
            });
        }

        if (Request::is('*/user/permission/*')) {
            Route::bind('permission', function ($permission) {
                $permissionrepo = $this->app->make('\Litepie\User\Interfaces\PermissionRepositoryInterface');
                return $permissionrepo->findorNew($permission);
            });
        }

        if (Request::is('*/user/role/*')) {
            Route::bind('role', function ($role) {
                $rolerepo = $this->app->make('\Litepie\User\Interfaces\RoleRepositoryInterface');
                return $rolerepo->findorNew($role);
            });
        }

        if (Request::is('*/user/team/*')) {
            Route::bind('team', function ($team) {
                $teamrepo = $this->app->make('\Litepie\User\Interfaces\TeamRepositoryInterface');
                return $teamrepo->findorNew($team);
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
            'middleware' => 'web',
            'namespace'  => $this->namespace,
            'prefix'     => trans_setlocale(),
        ], function ($router) {
            require (__DIR__ . '/../routes/web.php');
        });

        Route::group([
            'middleware' => 'web',
            'prefix'     => trans_setlocale(),
        ], function ($router) {
            require (__DIR__ . '/../routes/webuser.php');
        });
    }

    /**
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
            'prefix'     => trans_setlocale() . '/api',
        ], function ($router) {
            require (__DIR__ . '/../routes/api.php');
        });

        Route::group([
            'middleware' => 'api',
            'prefix'     => trans_setlocale() . '/api',
        ], function ($router) {
            require (__DIR__ . '/../routes/apiuser.php');
        });
    }

}
