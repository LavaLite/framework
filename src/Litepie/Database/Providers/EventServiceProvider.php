<?php

namespace Litepie\Database\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event handler mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'Litepie\Database\Events\RepositoryEntityCreated' => [
            'Litepie\Database\Listeners\CleanCacheRepository',
        ],
        'Litepie\Database\Events\RepositoryEntityUpdated' => [
            'Litepie\Database\Listeners\CleanCacheRepository',
        ],
        'Litepie\Database\Events\RepositoryEntityDeleted' => [
            'Litepie\Database\Listeners\CleanCacheRepository',
        ],
    ];
}
