<?php

namespace Litepie\User\Traits\Auth\Api;

use Auth;
use Request;

/**
 * Trait for managing user profile.
 */
trait Common
{


    /**
     * Get the guard to be used during authentication.
     *
     * @return string|null
     */
    protected function getGuard()
    {
        return property_exists($this, 'guard') && !is_null($this->guard) 
        ? $this->guard : Request::route('guard', null);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return string|null
     */
    protected function guard()
    {
        $guard = $this->getGuard();
        return Auth::guard($guard);
    }

    /**
     * Set guard for the auth controller.
     *
     * @return response
     */
    public function setPasswordBroker()
    {
        $guard = $this->getGuard();

        if (!empty($guard)) {
            return $this->broker = current(explode(".", $guard));
        }

    }

    /**
     * Get the model for the current guard.
     *
     * @return Response
     */
    function getModel($guard)
    {
        $provider = config("auth.guards.$guard.provider", 'users');
        return config("auth.providers.$provider.model", App\User::class);
    }

    /**
     * Get the model for the current guard.
     *
     * @return Response
     */
    function getTable($guard)
    {
        $provider = config("auth.guards.$guard.provider", 'users');

        return config("auth.providers.$provider.table", 'users');
    }


    /**
     * Check the given guard.
     *
     * @param  string  $name
     * @return \Illuminate\Contracts\Auth\Guard|\Illuminate\Contracts\Auth\StatefulGuard
     *
     * @throws \InvalidArgumentException
     */
    function check($name)
    {

        $config = config("auth.guards.{$name}");

        if (!is_null($name) && is_null($config)) {
            throw new InvalidArgumentException("Auth guard [{$name}] is not defined.");
        }

        return;

    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return string|null
     */
    protected function getApiGuard()
    {
        $guard = $this->getGuard();

        if (empty($guard)) {
            return config('auth.defaults.api');
        }

        return str_replace('web', 'api', $guard);
    }



}
