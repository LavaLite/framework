<?php

namespace Litepie\User\Mailers;

use Mail;

abstract class Mailer
{
    public function sendTo($email, $subject, $view, $data = [])
    {
        Mail::queue($view, $data, function ($message) use ($email, $subject) {
            $message->to($email)
                     ->subject($subject);

        });
    }
}
