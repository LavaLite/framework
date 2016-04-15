<?php

namespace Litepie\User\Traits;

use Illuminate\Foundation\Auth\ResetsPasswords;

trait PasswordManager
{

    use ResetsPasswords;

    /**
     * Display the password reset view for the given token.
     *
     * If no token is present, display the link request form.
     *
     * @param  string|null                 $token
     * @return \Illuminate\Http\Response
     */
    public function showResetForm($token = null)
    {

        if (is_null($token)) {
            return $this->getEmail();
        }

        return $this->theme->of('user::user.reset', compact('token'))
            ->render();
    }

    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLinkRequestForm()
    {
        return $this->theme->of('user::user.password')->render();
    }

    /**
     * Display the form to request a password reset link.
     * @return \Illuminate\Http\Response
     */
    public function getEmail()
    {
        return $this->theme->of('user::user.password')->render();
    }

}
