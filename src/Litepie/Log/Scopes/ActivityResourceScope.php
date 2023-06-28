<?php

namespace Litepie\Log\Scopes;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class ActivityResourceScope implements Scope
{
    public function onlyShowDeletedForAdmins($duilder)
    {
        // if (Auth::user()->isAdmin()) {
        //     return $model->withTrashed();
        // }
        return $duilder;
    }

    public function apply(Builder $duilder, Model $model)
    {
        return $this->onlyShowDeletedForAdmins($duilder);
    }

}