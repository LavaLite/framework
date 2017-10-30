<?php

namespace Litepie\Roles\Providers;

use Illuminate\Interfaces\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'Litepie\Roles\Events\UserEvent' => [
            'Litepie\Roles\Listeners\UserListener',
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param \Illuminate\Interfaces\Events\Dispatcher $events
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
