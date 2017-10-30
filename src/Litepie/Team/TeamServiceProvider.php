<?php
namespace Litepie\Workflow;

use Illuminate\Support\ServiceProvider;
use Litepie\Workflow\Workflow;
use Litepie\Contracts\Workflow\Workflow as WorkflowContract;

class WorkflowServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        // Load view
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'workflow');

        // Load translation
        $this->loadTranslationsFrom(__DIR__ . '/resources/lang', 'workflow');

        // Call pblish redources function
        $this->publishResources();

    }


    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // Bind 'workflow' shared component to the IoC container
        $this->app->bind('workflow', function ($app) {
            return new Workflow($app);
        });

        $this->app->singleton(WorkflowContract::class, function ($app) {
            return new Workflow($app);
        });

        // Bind facade
/*        $this->app->bind('workflow', function ($app) {
            return $this->app->make('Litepie\Workflow\Workflow');
        });
*/
        // Bind Workflow to repository
        $this->app->bind(
            'Litepie\Workflow\Interfaces\WorkflowRepositoryInterface',
            \Litepie\Workflow\Repositories\Eloquent\WorkflowRepository::class
        );

        $this->app->register(\Litepie\Workflow\Providers\AuthServiceProvider::class);
        $this->app->register(\Litepie\Workflow\Providers\EventServiceProvider::class);
        $this->app->register(\Litepie\Workflow\Providers\RouteServiceProvider::class);

    }
    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [WorkflowContract::class];
    }
    /**
     * Publish resources.
     *
     * @return void
     */
    private function publishResources()
    {
        // Publish configuration file
        $this->publishes([__DIR__ . '/config/config.php' => config_path('litepie/workflow.php')], 'config');

        // Publish admin view
        $this->publishes([__DIR__ . '/resources/views' => base_path('resources/views/vendor/workflow')], 'view');

        // Publish language files
        $this->publishes([__DIR__ . '/resources/lang' => base_path('resources/lang/vendor/workflow')], 'lang');

    }


}