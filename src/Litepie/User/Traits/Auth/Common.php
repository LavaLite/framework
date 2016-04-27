<?php

namespace Litepie\User\Traits\Auth;

use Auth;

/**
 * Trait for managing user profile.
 */
trait Common
{

    /**
     * Check whether the view exists for the role, else return defaut role.
     *
     * @param type $view
     * @param type $role
     * @return type
     */
    public function getView($view)
    {
        $guard = $this->getViewFolder();

        if (is_null($guard)) {
            return "user::public.default.$view";
        }

        $guard = current(explode(".", $guard));

        if (view()->exists("user::public.$guard.$view")) {
            return "user::public.$guard.$view";
        }

        return "user::public.default.$view";

    }

    /**
     * Set guard for the auth controller.
     *
     * @return response
     */
    public function setGuard($guard)
    {
        $guard              = empty($guard) ? null : $guard;
        return $this->guard = $guard;

    }

    /**
     * Get the guard used for the controller.
     *
     * @return string|null
     */
    protected function getGuard()
    {
        return property_exists($this, 'guard') && !in_array($this->guard, config('auth.defaults.guards')) ? $this->guard : null;
    }

    /**
     * Get the guard used for the controller.
     *
     * @return string|null
     */
    protected function getViewFolder()
    {
        return property_exists($this, 'guard') ? $this->guard : null;
    }

}
