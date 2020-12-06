<?php

namespace Litepie\User\Traits;

trait RoutesAndGuards
{
    /**
     * Get the model for the current guard.
     *
     * @return Response
     */
    public function getAuthModel()
    {
        $guard = guard();
        $guard = ($guard == null) ? $guard : config('auth.defaults.guard');
        $provider = config('auth.guards.'.$guard.'.provider');

        return config("auth.providers.$provider.model");
    }

    /**
     * Return auth guard route for the controller.
     *
     * @return type
     */
    protected function getGuardRoute()
    {
        $guard = guard();

        if (empty($guard)) {
            config('auth.defaults.guard');
        }

        return current(explode('.', $guard));
    }

    /**
     * Return auth guard route for the controller.
     *
     * @return type
     */
    protected function getPasswordBroker()
    {
        $guard = guard();
        $guard = ($guard == null) ? $guard : config('auth.defaults.guard');

        return current(explode('.', $guard));
    }

    /**
     * Return auth guard for the controller.
     *
     * @return type
     */
    protected function getGuardTable()
    {
        $model = $this->getAuthModel();

        return with(new $model())->getTable();
    }

    /**
     * Return homepage for the user.
     *
     * @return Response
     */
    public function redirectTo()
    {
        $guard = guard();

        if (!empty($guard)) {
            return current(explode('.', $guard));
        }

        return config('auth.defaults.url');
    }

    /**
     * Sets guard for the controller.
     *
     * @return null
     */
    protected function setGuard()
    {
        $guard = request()->route('guard');
        $sub = request()->is('*api/*') ? 'api' : 'web';
        guard($guard.'.'.$sub);
    }
}
