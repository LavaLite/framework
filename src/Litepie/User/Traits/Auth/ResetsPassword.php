<?php

namespace Litepie\User\Traits\Auth;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\RedirectsUsers;

trait ResetsPassword
{

    use Common, RedirectsUsers;

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
        
        $this->response->title('Reset')->view($this->getView('auth.reset', 'user'), compact('token','email'))->output();        
    }
    
    /**
     * Display the form to request a password reset link.
     * @return \Illuminate\Http\Response
     */
    function getEmail($guard = null)
    {
        $this->response->title('Reset')->view($this->getView('password'), compact('guard'))->output();
    }
}
