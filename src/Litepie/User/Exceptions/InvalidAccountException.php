<?php

namespace Litepie\User\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;

class InvalidAccountException extends AuthorizationException
{
    /**
     * Create a new inactive account exception instance.
     *
     * @param string $permission
     */
    public function __construct($message = 'Unauthorized', $code = 403)
    {
        $this->message = $message;
        $this->code    = $code;
    }
}
