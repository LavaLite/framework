<?php

namespace Litepie\Repository\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event handler mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'Litepie\Repository\Events\RepositoryEntityCreated' => [
            'Litepie\Repository\Listeners\CleanCacheRepository',
        ],
        'Litepie\Repository\Events\RepositoryEntityUpdated' => [
            'Litepie\Repository\Listeners\CleanCacheRepository',
        ],
        'Litepie\Repository\Events\RepositoryEntityDeleted' => [
            'Litepie\Repository\Listeners\CleanCacheRepository',
        ],
    ];
}
