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
    function showResetForm($guard = null, $token = null)
    {

        if (is_null($token)) {
            return $this->getEmail($guard);
        }

        return $this->theme->of($this->getView('reset'), compact('token'))
            ->render();
    }

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    function postReset($guard, Request $request)
    {
        dd('f');
        return $this->reset($request);
    }

    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\Http\Response
     */
    function showLinkRequestForm($guard = null)
    {

        return $this->theme->of($this->getView('password'), compact('guard'))->render();
    }

    /**
     * Display the form to request a password reset link.
     * @return \Illuminate\Http\Response
     */
    function getEmail($guard = null)
    {

        return $this->theme->of($this->getView('password'), compact('guard'))->render();
    }

    /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    function postEmail($guard = null, Request $request)
    {
        return $this->sendResetLinkEmail($request);
    }

}
