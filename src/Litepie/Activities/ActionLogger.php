<?php

namespace Litepie\Activities;

use Illuminate\Auth\AuthManager;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Traits\Macroable;
use Litepie\Activities\Contracts\Action as ActionContract;
use Spatie\Activitylog\Exceptions\CouldNotLogActivity;

class ActionLogger
{
    use Macroable;

    /** @var \Illuminate\Auth\AuthManager */
    protected $auth;

    protected $defaultLogName = '';

    /** @var string */
    protected $authDriver;

    /** @var \Spatie\Activitylog\Contracts\Activity */
    protected $action;

    public function __construct(AuthManager $auth, Repository $config)
    {
        $this->auth = $auth;

        $this->authDriver = $config['activitylog']['default_auth_driver'] ?? $auth->getDefaultDriver();

        $this->defaultLogName = $config['activitylog']['default_log_name'];
    }

    public function performedOn(Model $model)
    {
        $this->getAction()->subject()->associate($model);

        return $this;
    }

    public function on(Model $model)
    {
        return $this->performedOn($model);
    }

    public function causedBy($modelOrId)
    {
        if ($modelOrId === null) {
            return $this;
        }

        $model = $this->normalizeCauser($modelOrId);

        $this->getAction()->causer()->associate($model);

        return $this;
    }

    public function by($modelOrId)
    {
        return $this->causedBy($modelOrId);
    }

    public function causedByAnonymous()
    {
        $this->action->causer_id = null;
        $this->action->causer_type = null;

        return $this;
    }

    public function byAnonymous()
    {
        return $this->causedByAnonymous();
    }

    public function withProperties($properties)
    {
        $this->getAction()->properties = collect($properties);

        return $this;
    }

    public function withProperty(string $key, $value)
    {
        $this->getAction()->properties = $this->getAction()->properties->put($key, $value);

        return $this;
    }

    public function createdAt(Carbon $dateTime)
    {
        $this->getAction()->created_at = $dateTime;

        return $this;
    }

    public function useLog(string $logName)
    {
        $this->getAction()->log_name = $logName;

        return $this;
    }

    public function performAction(string $action)
    {
        $this->getAction()->action = $action;

        return $this;
    }

    public function inLog(string $logName)
    {
        return $this->useLog($logName);
    }

    public function tap(callable $callback, string $eventName = null)
    {
        call_user_func($callback, $this->getAction(), $eventName);

        return $this;
    }

    public function log(string $description)
    {
        $action = $this->action;

        $action->description = $this->replacePlaceholders(
            $action->description ?? $description,
            $action
        );
        $action->save();

        $this->action = null;

        return $action;
    }

    protected function normalizeCauser($modelOrId): Model
    {
        if ($modelOrId instanceof Model) {
            return $modelOrId;
        }

        $guard = $this->auth->guard($this->authDriver);
        $provider = method_exists($guard, 'getProvider') ? $guard->getProvider() : null;
        $model = method_exists($provider, 'retrieveById') ? $provider->retrieveById($modelOrId) : null;

        if ($model instanceof Model) {
            return $model;
        }

        throw CouldNotLogActivity::couldNotDetermineUser($modelOrId);
    }

    protected function replacePlaceholders(string $description, ActionContract $action): string
    {
        return preg_replace_callback('/:[a-z0-9._-]+/i', function ($match) use ($action) {
            $match = $match[0];

            $attribute = Str::before(Str::after($match, ':'), '.');

            if (!in_array($attribute, ['subject', 'causer', 'properties'])) {
                return $match;
            }

            $propertyName = substr($match, strpos($match, '.') + 1);

            $attributeValue = $action->$attribute;

            if (is_null($attributeValue)) {
                return $match;
            }

            $attributeValue = $attributeValue->toArray();

            return Arr::get($attributeValue, $propertyName, $match);
        }, $description);
    }

    protected function getAction(): ActionContract
    {
        if (!$this->action instanceof ActionContract) {
            $this->action = ActivitiesServiceProvider::getActionModelInstance();
            $this
                ->useLog($this->defaultLogName)
                ->withProperties([])
                ->causedBy($this->auth->guard($this->authDriver)->user());
        }

        return $this->action;
    }
}
