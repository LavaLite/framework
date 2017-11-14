<?php

namespace Litepie\Roles\Repositories\Presenter;

use League\Fractal\TransformerAbstract;
use Hashids;

class RoleItemTransformer extends TransformerAbstract
{
    public function transform(\Litepie\Roles\Models\Role $role)
    {
        return [
            'id'                => $role->getRouteKey(),
            'id'                => $role->id,
            'name'              => $role->name,
            'slug'              => $role->slug,
            'description'       => $role->description,
            'level'             => $role->level,
            'created_at'        => $role->created_at,
            'updated_at'        => $role->updated_at,
            'status'            => trans('app.'.$role->status),
            'created_at'        => format_date($role->created_at),
            'updated_at'        => format_date($role->updated_at),
        ];
    }
}