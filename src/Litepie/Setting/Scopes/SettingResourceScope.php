<?php

namespace Litepie\Setting\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class SettingResourceScope implements Scope
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
