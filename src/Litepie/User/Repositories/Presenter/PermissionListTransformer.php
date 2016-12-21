<?php

namespace Litepie\User\Repositories\Presenter;

use League\Fractal\TransformerAbstract;

class PermissionListTransformer extends TransformerAbstract
{
    public function transform(\Litepie\User\Models\Permission $permission)
    {
        return [
            'id'         => $permission->getRouteKey(),
            'slug'       => $permission->slug,
            'name'       => $permission->name,
            'created_at' => format_date($permission->created_at),
            'updated_at' => format_date($permission->updated_at),
        ];
    }
}
