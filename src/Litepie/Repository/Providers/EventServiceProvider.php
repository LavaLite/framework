<?php

namespace Litepie\Repository\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class EventServiceProvider.
 *
 * @author Renfos Technologies Pvt. Ltd. <info@info@renfos.com>
 */
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

    /**
     * Register the application's event listeners.
     *
     * @return void
     */
    public function boot()
    {
        $events = app('events');

        foreach ($this->listen as $event => $listeners) {
            foreach ($listeners as $listener) {
                $events->listen($event, $listener);
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function register()
    {
        //
    }

    /**
     * Get the events and handlers.
     *
     * @return array
     */
    public function listens()
    {
        return $this->listen;
    }
}
