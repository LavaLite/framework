<?php

namespace Litepie\Database\Traits;

use Litepie\Database\RequestScope;

trait Requestable
{

    /**
     * Boot the request scope for a model.
     *
     * @return void
     */
    public static function bootRequestable()
    {
        static::addGlobalScope(new RequestScope);
    }
}
