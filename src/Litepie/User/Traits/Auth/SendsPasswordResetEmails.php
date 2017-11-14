<?php

namespace Litepie\User\Traits\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

trait SendsPasswordResetEmails
{

    use Common, SendsPasswordResetEmails;
    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLinkRequestForm()
    {
        return $this->response->title('Reset')
            ->layout('auth')
            ->view('user::auth.password')
            ->output();
    }


}
