<?php

namespace Litepie\Team\Facades;

use Illuminate\Support\Facades\Facade;

class Teams extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'litepie.team';
    }
}
