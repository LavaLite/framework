<?php

namespace Litepie\User\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;

class RolesDeniedException extends AuthorizationException
{
    /**
     * Create a new role denied exception instance.
     *
     * @param string $role
     */
    public function __construct($roles)
    {
        $this->message = sprintf("You don't have a required ['%s'] role.", implode('|', $roles));
        $this->code    = 401;
    }
}
