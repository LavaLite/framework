<?php

namespace Litepie\Blog\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use Litepie\Blog\Models\Blog;
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
    protected $namespace = 'Litepie\Blog\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param   \Illuminate\Routing\Router  $router
     * @return void
     */
    public function boot()
    {
        parent::boot();

        if (Request::is('*/blog/blog/*')) {
            Route::bind('blog', function ($blog) {
                $blogrepo = $this->app->make(\Litepie\Blog\Interfaces\BlogRepositoryInterface::class);
                return $blogrepo->findorNew($blog);
            });
        }
        if (Request::is('*/blog/category/*')) {
            Route::bind('category', function ($blog_category) {
                $blog_categoryrepo = $this->app->make(\Litepie\Blog\Interfaces\BlogCategoryRepositoryInterface::class);
                return $blog_categoryrepo->findorNew($blog_category);
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
            'namespace' => $this->namespace,
            'prefix' => trans_setlocale(),
        ], function ($router) {
            require (__DIR__ . '/../routes/web.php');
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
            'namespace' => $this->namespace . '\Api',
            'prefix' => trans_setlocale() . '/api',
        ], function ($router) {
            require (__DIR__ . '/../routes/api.php');
        });
    }
}
