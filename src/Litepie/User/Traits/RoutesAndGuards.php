<?php

namespace Litepie\User\Traits;

use Auth;

trait RoutesAndGuards
{
    /**
     * Get the model for the current guard.
     *
     * @return Response
     */
    public function getAuthModel()
    {
        $provider = config('auth.guards.'.$this->getGuard().'.provider', 'users');

        return config("auth.providers.$provider.model", App\User::class);
    }

    /**
     * Return authguardroute for the controller.
     *
     * @return type
     */
    protected function getGuardRoute()
    {
        $guard = $this->getGuard();

        if (empty($guard)) {
            return 'user';
        }

        return current(explode('.', $guard));
    }

    /**
     * Return auth guard for the controller.
     *
     * @return type
     */
    protected function getGuard()
    {
        return getenv('guard');
    }

    /**
     * Return auth guard for the controller.
     *
     * @return type
     */
    protected function getTable()
    {
        $guard = $this->getGuard();
        $provider = config("auth.guards.$guard.provider", 'users');

        return config("auth.providers.$provider.table", 'users');
    }
}
