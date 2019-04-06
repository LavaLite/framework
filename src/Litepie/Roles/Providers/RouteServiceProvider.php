<?php

namespace Litepie\Roles\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Litepie\Roles\Models\Roles;
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
    protected $namespace = 'Litepie\Roles\Http\Controllers';

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

        if (Request::is('*/roles/role/*')) {
            Route::bind('role', function ($role) {
                $rolerepo = $this->app->make('Litepie\Roles\Interfaces\RoleRepositoryInterface');

                return $rolerepo->findorNew($role);
            });
        }

        if (Request::is('*/roles/permission/*')) {
            Route::bind('permission', function ($permission) {
                $permissionrepo = $this->app->make('Litepie\Roles\Interfaces\PermissionRepositoryInterface');

                return $permissionrepo->findorNew($permission);
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
        if (request()->segment(1) == 'api' || request()->segment(2) == 'api') {
            return;
        }

        Route::group([
            'middleware' => 'web',
            'namespace'  => $this->namespace,
        ], function ($router) {
            require __DIR__.'/../routes/web.php';
        });
    }
}
