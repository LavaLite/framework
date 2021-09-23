<?php

namespace Litepie\User\Traits\Auth;

use Auth;

/**
 * Trait for managing user profile.
 */
trait Common
{
    /**
     * Set guard for the auth controller.
     *
     * @return response
     */
    public function setPasswordBroker()
    {
        $guard = $this->getGuard();

        if (!empty($guard)) {
            return $this->broker = current(explode('.', $guard));
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
            return $this->redirectTo = current(explode('.', $guard));
        }

        return $this->redirectTo = 'user';
    }
}
