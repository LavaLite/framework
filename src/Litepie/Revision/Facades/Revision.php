<?php

namespace Litepie\Revision\Facades;

use Illuminate\Support\Facades\Facade;

class Revision extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'revision';
    }
}
