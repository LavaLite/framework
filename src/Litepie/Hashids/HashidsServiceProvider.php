<?php

namespace Litepie\Hashids;

use Hashids\Hashids;
use Illuminate\Support\ServiceProvider;

class HashidsServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // Bind 'hashids' shared component to the IoC container
        $this->app->singleton('hashids', function ($app) {
            // Read settings from config file
            $config = $app->config->get('hashids', []);

               return new Hashids($config['salt'], $config['length'], $config['alphabet']);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['hashids'];
    }
}
