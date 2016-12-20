<?php

namespace Litepie\User\Repositories\Presenter;

use League\Fractal\TransformerAbstract;

class RoleListTransformer extends TransformerAbstract
{
    public function transform(\Litepie\User\Models\Role $role)
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
