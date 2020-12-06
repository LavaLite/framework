<?php

namespace Litepie\User\Traits\Auth;

use Illuminate\Auth\MustVerifyEmail as IlluminateMustVerifyEmail;
use Litepie\User\Notifications\VerifyEmail;

trait MustVerifyEmail
{
    use IlluminateMustVerifyEmail;

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail());
    }
}
