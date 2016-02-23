<?php

namespace Litepie\User\Repositories\Presenter;

use League\Fractal\TransformerAbstract;

class PermissionListTransformer extends TransformerAbstract
{
    public function transform(\Litepie\User\Models\Permission $permission)
    {
        return [
            'id'                => $permission->getRouteKey(),
            'name'              => $permission->name,
            'slug'              => $permission->slug,
        ];
    }
}
