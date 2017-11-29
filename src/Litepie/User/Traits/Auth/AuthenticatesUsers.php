<?php

namespace Litepie\User\Traits\Auth;

use Auth;
use Crypt;
use Illuminate\Foundation\Auth\AuthenticatesUsers as IlluminateAuthenticatesUsers;
use Mail;
use Socialite;
use User;

trait AuthenticatesUsers
{

    use IlluminateAuthenticatesUsers, Common {
         Common::guard insteadof IlluminateAuthenticatesUsers;
    }


    /**
     * Show the user login form.
     *
     * @return \Illuminate\Http\Response
     */
    function showLoginForm()
    {
        $guard = $this->getGuardRoute();

        return $this->response
            ->title('Login')
            ->layout('auth')
            ->view('user::auth.login', true)
            ->data(compact('guard'))
            ->output();
    }
}
