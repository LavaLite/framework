<?php

namespace Lavalite\User\Repositories\Presenter;

use League\Fractal\TransformerAbstract;
use Hashids;

class RoleItemTransformer extends TransformerAbstract
{
    public function transform(\Lavalite\User\Models\Role $role)
    {
        return [
            'id'                => $role->getRouteKey(),
            'name'              => $role->name,
            'permissions'       => $role->permissions,
        ];
    }
}