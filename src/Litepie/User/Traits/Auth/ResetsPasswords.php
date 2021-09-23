<?php

namespace Litepie\User\Traits\Auth;

use Illuminate\Foundation\Auth\ResetsPasswords as IlluminateResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

trait ResetsPasswords
{
    use Common;
    use IlluminateResetsPasswords;

    /**
     * Display the password reset view for the given token.
     *
     * If no token is present, display the link request form.
     *
     * @param string|null $token
     *
     * @return \Illuminate\Http\Response
     */
    public function showResetForm(Request $request, $token = null)
    {
        $email = $request->email;

        return $this->response->setMetaTitle('Reset')
            ->view('auth.passwords.reset')
            ->layout('auth')
            ->data(compact('token', 'email'))
            ->output();
    }

    /**
     * Get the broker to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    public function broker()
    {
        return Password::broker(current(explode('.', guard())));
    }

    /**
     * Get the broker to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    public function redirectTo()
    {
        return current(explode('.', guard()));
    }
}
