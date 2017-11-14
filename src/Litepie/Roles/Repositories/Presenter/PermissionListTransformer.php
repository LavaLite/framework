<?php

namespace Litepie\Roles\Repositories\Presenter;

use League\Fractal\TransformerAbstract;
use Hashids;

class PermissionListTransformer extends TransformerAbstract
{
    public function transform(\Litepie\Roles\Models\Permission $permission)
    {
        return [
            'id'                => $permission->getRouteKey(),
            'id'                => $permission->id,
            'name'              => $permission->name,
            'slug'              => $permission->slug,
            'description'       => $permission->description,
            'created_at'        => $permission->created_at,
            'updated_at'        => $permission->updated_at,
            'created_at'        => format_date($permission->created_at),
            'updated_at'        => format_date($permission->updated_at),
        ];
    }
}