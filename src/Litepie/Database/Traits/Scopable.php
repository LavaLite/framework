<?php

namespace Litepie\Database\Traits;

use Illuminate\Database\Eloquent\Scope;

/**
 * This trait helps the model to attach
 * and remove the model scope on the fly.
 */
trait Scopable
{
    /**
     * Attach scope class on the fly.
     *
     * @return void
     */
    public static function pushScope(Scope $scope)
    {
        static::addGlobalScope($scope);

        return new static();
    }

    /**
     * Remove scope class on the fly.
     *
     * @return void
     */
    public function popScope(Scope $scope)
    {
        static::withoutGlobalScope(new $scope());

        return new static();
    }
}
