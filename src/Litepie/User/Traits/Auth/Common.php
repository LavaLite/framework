<?php

namespace Litepie\User\Traits\Auth;

use Auth;
use Theme;

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
     * Set guard for the auth controller.
     *
     * @return response
     */
    public function setTheme()
    {
        $view        = $this->getViewFolder();
        $theme       = Theme::exists($view) ? $view : config('theme.default.theme');
        $this->theme = Theme::uses($theme);
        $this->theme->layout(config("theme.$theme.auth", 'auth'));
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return string|null
     */
    protected function getGuard()
    {
        return property_exists($this, 'guard') ? $this->guard : config('auth.defaults.guard');
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

    /**
     * Get the guard used for the controller.
     *
     * @return string|null
     */
    protected function getViewFolder($default = 'public')
    {
        $guard = $this->getGuard();

        if (is_null($guard)) {
            return $default;
        }

        return str_singular(current(explode(".", $guard)));
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

        if (property_exists($this, 'home')) {
            return $this->redirectTo = $this->home;
        }

        return;
    }

}
