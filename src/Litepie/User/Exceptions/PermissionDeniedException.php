<?php

namespace Litepie\User\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;

class PermissionDeniedException extends AuthorizationException
{
    /**
     * Create a new permission denied exception instance.
     *
     * @param string $permission
     */
    public function __construct($permission)
    {
        $this->message = sprintf("You don't have a required ['%s'] permission.", $permission);
        $this->code    = 401;
    }
}
