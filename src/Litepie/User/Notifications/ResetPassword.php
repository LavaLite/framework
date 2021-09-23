<?php

namespace Litepie\User\Notifications;

use Illuminate\Auth\Notifications\ResetPassword as IlluminateResetPassword;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPassword extends IlluminateResetPassword
{
    /**
     * Build the mail representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable, $this->token);
        }

        return (new MailMessage())
            ->subject(__('Reset Password Notification'))
            ->line(__('You are receiving this email because we received a password reset request for your account.'))
            ->action(
                __('Reset Password'),
                $this->passwordUrl()
            )
            ->line(__('This password reset link will expire in :count minutes.', ['count' => config('auth.passwords.users.expire')]))
            ->line(__('If you did not request a password reset, no further action is required.'));
    }

    /**
     * Get the verification URL for the given notifiable.
     *
     * @param mixed $notifiable
     *
     * @return string
     */
    protected function passwordUrl()
    {
        return url(
            trans_url('/').route(
                'guard.password.reset',
                [
                    'token' => $this->token,
                    'guard' => current(explode('.', guard())),
                ],
                false
            )
        );
    }
}
