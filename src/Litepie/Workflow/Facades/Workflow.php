<?php

namespace Litepie\Workflow\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @author Boris Koumondji <brexis@yahoo.fr>
 */
class Workflow extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'workflow';
    }
}
