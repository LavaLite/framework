<?php

namespace Litepie\Setting\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class SettingPublicScope implements Scope
{
    public function onlyPublished($duilder)
    {
        return $duilder->where('status', 'Published');
    }

    public function apply(Builder $duilder, Model $model)
    {
        return $this->onlyPublished($duilder);
    }
}
