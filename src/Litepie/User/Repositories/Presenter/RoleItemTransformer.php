<?php

namespace Litepie\User\Repositories\Presenter;

use League\Fractal\TransformerAbstract;
use Hashids;

class RoleItemTransformer extends TransformerAbstract
{
    public function transform(\Litepie\User\Models\Role $role)
    {
        return [
            'id'                => $role->getRouteKey(),
            'name'              => $role->name,
            'permissions'       => $role->permissions,
        ];
    }
}