<?php

namespace Litepie\User\Traits\Auth;

use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Request;

trait PasswordManager
{

    use ResetsPasswords, Common {
        Common::getGuard insteadof ResetsPasswords;
    }

    /**
     * Display the password reset view for the given token.
     *
     * If no token is present, display the link request form.
     *
     * @param  string|null                 $token
     * @return \Illuminate\Http\Response
     */
    function showResetForm($token = null)
    {

        $guard = Request::input(config('user.params.type'), 'role');

        if (is_null($token)) {
            return $this->getEmail();
        }

        return $this->theme->of($this->getView('reset'), compact('token'))
            ->render();
    }

    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\Http\Response
     */
    function showLinkRequestForm()
    {
        $guard = Request::input(config('user.params.type'), 'role');

        return $this->theme->of($this->getView('password'), compact('guard'))->render();
    }

    /**
     * Display the form to request a password reset link.
     * @return \Illuminate\Http\Response
     */
    function getEmail()
    {

        $guard = Request::input(config('user.params.type'), 'role');

        return $this->theme->of($this->getView('password'), compact('guard'))->render();
    }

}
