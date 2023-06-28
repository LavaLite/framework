<?php

namespace Litepie\Role\Facades;

use Illuminate\Support\Facades\Facade;

class Role extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'role';
    }
}
