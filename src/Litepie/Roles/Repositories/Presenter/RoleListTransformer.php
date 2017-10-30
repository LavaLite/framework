<?php

namespace Litepie\Roles\Repositories\Presenter;

use League\Fractal\TransformerAbstract;

class RoleListTransformer extends TransformerAbstract
{
    public function transform(\Litepie\Roles\Models\Role $role)
    { 
        return [
            'id'          => $role->getRouteKey(),
            'name'        => $role->name,
            'key'         => $role->key,
            'permissions' => $role->permissions,
            'created_at'  => format_date($role->created_at),
            'updated_at'  => format_date($role->updated_at),
        ];
    }
}
