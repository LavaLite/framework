<?php

namespace Litepie\User\Traits\Auth;

use Auth;
use Request;
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
        if (view()->exists("$guard::auth.$view")) {
            return "$guard::auth.$view";
        }
        return "user::auth.$view";

    }

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
     * Set guard for the auth controller.
     *
     * @return response
     */
    public function setTheme()
    {
        $view        = $this->getViewFolder();
        $theme       = Theme::exists($view) ? $view : config('theme.themes.default.theme');
        $this->theme = Theme::uses($theme);
        $this->theme->layout(config("theme.$theme.auth", 'auth'));
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

    /**
     * Get the guard used for the controller.
     *
     * @return string|null
     */
    protected function getViewFolder($default = 'user')
    {
        $guard = $this->getGuard();

        if (is_null($guard) || $guard == 'web') {
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
