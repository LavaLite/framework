<?php

namespace Litepie\Database\Facades;

use Illuminate\Support\Facades\Facade;

class ModelMacro extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'model-macro';
    }
}
