<?php

namespace Litepie\Foundation\Providers;

use Illuminate\Support\ServiceProvider;

abstract class ActionServiceProvider extends ServiceProvider
{
    /**
     * The action mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $actions = [];

    /**
     * Register the application's actions.
     *
     * @return void
     */
    public function boot()
    {
        foreach ($this->actions() as $model => $action) {
            app('action')->addFromArray($model, $action);
        }
    }

    /**
     * Get the actions defined on the provider.
     *
     * @return array<class-string, class-string>
     */
    abstract public function actions();
}
