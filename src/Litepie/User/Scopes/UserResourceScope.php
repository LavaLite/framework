<?php

namespace Litepie\User\Scopes;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class UserResourceScope implements Scope
{
    public function onlyShowDeletedForAdmins($builder)
    {
        // if (Auth::user()->isAdmin()) {
        //     return $model->withTrashed();
        // }
        return $builder;
    }

    public function apply(Builder $builder, Model $model)
    {
        $status = request()->status;
        switch ($status) {
            case 'active':
                $builder =  $builder->where('status', 'Active');
                break;
            case 'inactive':
                $builder =  $builder->where('status', '!=', 'Active');
                break;
        }
        return $builder;
    }
}
