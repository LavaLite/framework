<?php

namespace Litepie\User\Repositories\Presenter;

use League\Fractal\TransformerAbstract;
use Hashids;

class RoleListTransformer extends TransformerAbstract
{
    public function transform(\Litepie\User\Models\Role $name)
    {
        return [
            'id' => $name->getRouteKey(),
            'name' => $name->name,
        ];
    }
}


