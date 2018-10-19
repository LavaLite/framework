<?php

namespace Litepie\Settings;

use Illuminate\Support\ServiceProvider;

class SettingsServiceProvider extends ServiceProvider
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
        $this->loadViewsFrom(__DIR__.'/resources/views', 'settings');

        // Load translation
        $this->loadTranslationsFrom(__DIR__.'/resources/lang', 'settings');

        // Load migrations
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

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
        $configPath = __DIR__.'/config/config.php';
        $this->mergeConfigFrom($configPath, 'settings');

        // Bind facade
        $this->app->bind('settings', function ($app) {
            return $this->app->make(\Litepie\Settings\Settings::class);
        });

        // Bind Setting to repository
        $this->app->bind(
            'Litepie\Settings\Interfaces\SettingRepositoryInterface',
            \Litepie\Settings\Repositories\Eloquent\SettingRepository::class
        );

        $this->app->register(\Litepie\Settings\Providers\AuthServiceProvider::class);

        $this->app->register(\Litepie\Settings\Providers\RouteServiceProvider::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['settings'];
    }

    /**
     * Publish resources.
     *
     * @return void
     */
    private function publishResources()
    {
        // Publish configuration file
        $this->publishes([__DIR__.'/config/config.php' => config_path('litepie/settings.php')], 'config');

        // Publish admin view
        $this->publishes([__DIR__.'/resources/views' => base_path('resources/views/vendor/settings')], 'view');

        // Publish language files
        $this->publishes([__DIR__.'/resources/lang' => base_path('resources/lang/vendor/settings')], 'lang');

        // Publish public files and assets.
        $this->publishes([__DIR__.'/public/' => public_path('/')], 'public');
    }
}
