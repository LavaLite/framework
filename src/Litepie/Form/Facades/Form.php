<?php

namespace Litepie\Form\Facades;

use Illuminate\Support\Facades\Facade;

class Form extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'former';
    }
}
