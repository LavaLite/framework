<?php

namespace Litepie\User\Traits\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers as IlluminateAuthenticatesUsers;

trait AuthenticatesUsers
{
    use IlluminateAuthenticatesUsers;

    /**
     * Show the user login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        $guard = $this->getGuardRoute();

        return $this->response
            ->setMetaTitle('Login')
            ->layout('auth')
            ->view('auth.login')
            ->data(compact('guard'))
            ->output();
    }

}
