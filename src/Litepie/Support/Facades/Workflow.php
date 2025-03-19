<?php

namespace Litepie\Support\Facades;

use Illuminate\Support\Facades\Facade;


class Workflow extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'litepie.workflow';
    }
}
