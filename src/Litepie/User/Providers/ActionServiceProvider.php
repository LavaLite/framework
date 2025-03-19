<?php

namespace Litepie\User\Providers;

use Litepie\Foundation\Providers\ActionServiceProvider as ServiceProvider;

class ActionServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function actions()
    {
        return [
            \Litepie\User\Models\User::class => config('user.user.actions')
        ];
    }
}
