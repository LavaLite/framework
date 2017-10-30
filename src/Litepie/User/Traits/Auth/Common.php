<?php

namespace Litepie\User\Traits\Auth;

use Auth;

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
     * Return homepage for the user.
     *
     * @return Response
     */
    public function setRedirectTo()
    {

        $guard = $this->getGuard();

        if (!empty($guard)) {
            return $this->redirectTo = current(explode(".", $guard));
        }

        return $this->redirectTo = 'user';
    }

    /**
     * Check the given guard is avilable and can register online.
     *
     * @param  string  $name
     * @return \Illuminate\Contracts\Auth\Guard|\Illuminate\Contracts\Auth\StatefulGuard
     *
     * @throws \InvalidArgumentException
     */
    function canRegister($name)
    {
        $config = config("auth.registrable.{$name}");
        if (!is_null($name) && is_null($config)) {
            throw new InvalidArgumentException("Auth guard [{$name}] is not defined.");
        }
        return true;
    }

}
