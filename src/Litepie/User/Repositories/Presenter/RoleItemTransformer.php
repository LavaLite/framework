<?php

namespace Litepie\User\Repositories\Presenter;

use League\Fractal\TransformerAbstract;

class RoleItemTransformer extends TransformerAbstract
{
    public function transform(\Litepie\User\Models\Role $role)
    {
        return [
            'id'          => $role->getRouteKey(),
            'key'         => $role->key,
            'name'        => $role->name,
            'permissions' => $role->permissions,
            'created_at'  => format_date($role->created_at),
            'updated_at'  => format_date($role->updated_at),
        ];
    }
}
