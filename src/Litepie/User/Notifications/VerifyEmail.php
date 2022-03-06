<?php

namespace Litepie\User\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail as IlluminateVerifyEmail;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;

class VerifyEmail extends IlluminateVerifyEmail
{
    /**
     * Get the verification URL for the given notifiable.
     *
     * @param mixed $notifiable
     *
     * @return string
     */
    protected function verificationUrl($notifiable)
    {
        return URL::temporarySignedRoute(
            'guard.verification.verify',
            Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
            [
                'id'      => $notifiable->getKey(),
                'hash'    => sha1($notifiable->getEmailForVerification()),
                'guard'   => current(explode('.', guard())),
            ]
        );
    }
}
