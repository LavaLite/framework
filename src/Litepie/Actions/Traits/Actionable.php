<?php

namespace Litepie\Actions\Traits;

trait Actionable
{
    public function actions()
    {
        return app('action')->get(self::class);
    }
}
