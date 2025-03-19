<?php

namespace Litepie\Database;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\ServiceProvider;

class DatabaseServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureMacros();
    }

    /**
     * Configure the macros to be used.
     *
     * @return void
     */
    protected function configureMacros()
    {
        Blueprint::macro('archivedAt', function ($column = 'archived_at', $precision = 0) {
            return $this->timestamp($column, $precision)->nullable();
        });

        Blueprint::macro('dropArchivedAt', function ($column = 'archived_at') {
            return $this->drop($column);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('model-macro', function () {
            return new ModelMacro();
        });
    }
}
