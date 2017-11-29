<?php

namespace Litepie\User\Traits\Auth;

use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\ResetsPasswords as IlluminateResetsPasswords;

trait ResetsPasswords
{

    use Common, RedirectsUsers, IlluminateResetsPasswords{
        Common::guard insteadof IlluminateResetsPasswords;
        RedirectsUsers::redirectPath insteadof IlluminateResetsPasswords;
    }
    /**
     * Display the password reset view for the given token.
     *
     * If no token is present, display the link request form.
     *
     * @param  string|null                 $token
     * @return \Illuminate\Http\Response
     */

    function showResetForm(Request $request, $token = null)
    {
        $email = $request->email;

        return $this->response->title('Reset')
            ->view('user::auth.reset', true)
            ->data(compact('token', 'email'))
            ->output();
    }

}
