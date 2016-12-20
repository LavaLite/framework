<?php

namespace Litepie\User\Contracts;

/**
 *
 * User policy interface
 *
 */

interface UserPolicy
{

    public function canDo($permission);

    //public function is($role);

}
