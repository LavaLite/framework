<?php

namespace Litepie\Log\Traits;

trait Actionable
{
    public function actions()
    {
        return app('action')->get(self::class);
    }
}
