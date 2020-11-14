<?php

namespace Litepie\Support\Facades;

use Illuminate\Support\Facades\Facade as IlluminateFacade;

class Hashids extends IlluminateFacade
{
    /**
     * Get the registered component.
     *
     * @return object
     */
    protected static function getFacadeAccessor()
    {
        return 'hashids';
    }
}
