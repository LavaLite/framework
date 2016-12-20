<?php

namespace Litepie\User\Repositories\Presenter;

use League\Fractal\TransformerAbstract;

class PermissionItemTransformer extends TransformerAbstract
{
    public function transform(\Litepie\User\Models\Permission $permission)
    {
        return [
            'id'         => $permission->getRouteKey(),
            'slug'       => $permission->slug,
            'name'       => $permission->name,
            'created_at' => format_date($team->created_at),
            'updated_at' => format_date($team->updated_at),
        ];
    }
}
