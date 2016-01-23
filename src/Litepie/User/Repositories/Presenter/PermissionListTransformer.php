<?php

namespace Lavalite\User\Repositories\Presenter;

use League\Fractal\TransformerAbstract;
use Hashids;

class PermissionListTransformer extends TransformerAbstract
{
    public function transform(\Litepie\User\Models\Permission $permission)
    {
        return [
            'id' => $permission->eid,
            'slug' => $permission->slug,
            'name' => $permission->name
        ];
    }
}


