<?php

namespace Litepie\User\Traits\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails as IlluminateSendsPasswordResetEmails;

trait SendsPasswordResetEmails
{

    use Common, IlluminateSendsPasswordResetEmails;
    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLinkRequestForm()
    {
        return $this->response->title('Forgot Password')
            ->layout('auth')
            ->view('auth.password')
            ->output();
    }

    /**
     * Get the broker to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    public function broker()
    {
        return Password::broker(get_guard('route'));
    }
}
