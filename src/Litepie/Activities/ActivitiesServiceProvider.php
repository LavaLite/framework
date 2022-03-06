<?php

namespace Litepie\Activities;

use Illuminate\Database\Eloquent\Model;
use Litepie\Activities\Contracts\Action as ActionContract;
use Litepie\Activities\Models\Action as ActionModel;
use Spatie\Activitylog\ActivitylogServiceProvider;
use Spatie\Activitylog\CleanActivitylogCommand;
use Spatie\Activitylog\Exceptions\InvalidConfiguration;

class ActivitiesServiceProvider extends ActivitylogServiceProvider
{
    /**
     * Bootstrap the application events.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/activities.php' => config_path('activities.php'),
        ], 'config');

        $this->app['config']->set('activitylog', config('activities', []));

        $this->mergeConfigFrom(
            __DIR__.'/config/activities.php',
            'activitylog'
        );
        // Load migrations
        $this->loadMigrationsFrom(__DIR__.'/migrations');
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->app->bind('command.activities:clean', CleanActivitylogCommand::class);

        $this->commands([
            'command.activities:clean',
        ]);

        // Bind ActivityLog to repository
        $this->app->bind(
            'Litepie\Activities\Repositories\ActivityLogRepositoryInterface',
            \Litepie\Activities\Repositories\Eloquent\ActivityLogRepository::class
        );

        // Bind ActionLog to repository
        $this->app->bind(
            'Litepie\Activities\Repositories\ActionLogRepositoryInterface',
            \Litepie\Activities\Repositories\Eloquent\ActionLogRepository::class
        );
    }

    public static function determineActionModel(): string
    {
        $actionModel = config('activitylog.action_model') ?? ActionModel::class;

        if (!is_a($actionModel, ActionModel::class, true)
            || !is_a($actionModel, Model::class, true)) {
            throw InvalidConfiguration::modelIsNotValid($actionModel);
        }

        return $actionModel;
    }

    public static function getActionModelInstance(): ActionContract
    {
        $actionModelClassName = self::determineActionModel();

        return new $actionModelClassName();
    }
}
