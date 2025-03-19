<?php

namespace Litepie\States;

use Illuminate\Support\ServiceProvider;

class StatesServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/Database/migrations');

    }

    public function register()
    {
        //
    }
}
