<?php

namespace Litepie\Contact\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Litepie\Contact\Models\Contact;
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
    protected $namespace = 'Litepie\Contact\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        if (Request::is('*/contact/contact/*')) {
            Route::bind('contact', function ($id) {
                $contact = $this->app->make('\Litepie\Contact\Interfaces\ContactRepositoryInterface');
                return $contact->findorNew($id);
            });
        }

    }

    /**
     * Define the routes for the litepie.
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
     * Define the "web" routes for the litepie.
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
    }

    /**
     * Define the "api" routes for the litepie.
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
    }

}
