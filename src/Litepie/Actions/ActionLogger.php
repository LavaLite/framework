<?php

namespace Litepie\Actions;

use Illuminate\Auth\AuthManager;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Traits\Macroable;
use Litepie\Actions\Contracts\Action as ActionContract;
use Litepie\Actions\Models\Action;
use Spatie\Activitylog\Exceptions\CouldNotLogActivity;

class ActionLogger
{
    use Macroable;

    /** @var \Illuminate\Auth\AuthManager */
    protected $auth;

    protected $defaultLogName = '';

    /** @var string */
    protected $authDriver;

    protected $action;

    public function __construct(AuthManager $auth, Repository $config)
    {
        $this->auth = $auth;
        $this->authDriver = $config['actionlog']['default_auth_driver'] ?? $auth->getDefaultDriver();
        $this->defaultLogName = $config['actionlog']['default_log_name'];
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

    public function performAction(string $action)
    {
        $this->getAction()->action = $action;

        return $this;
    }

    public function save()
    {
        $action = $this->action;

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

    protected function getAction(): ActionContract
    {
        if (!$this->action instanceof ActionContract) {
            $this->action = app(Action::class);
            $this->action($this->defaultLogName)
                ->causedBy($this->auth->guard($this->authDriver)->user());
        }

        return $this->action;
    }

    public function action($action = null)
    {
        $this->getAction()->action = $action;
        return $this;
    }

    public function description($description = null)
    {
        $this->getAction()->description = $description;
        return $this;
    }

    public function property($property = null)
    {
        $this->getAction()->property = $property;
        return $this;
    }
}
