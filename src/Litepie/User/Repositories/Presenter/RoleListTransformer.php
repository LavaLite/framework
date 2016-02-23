<?php

namespace Litepie\User\Repositories\Presenter;

use League\Fractal\TransformerAbstract;

class RoleListTransformer extends TransformerAbstract
{
    public function transform(\Litepie\User\Models\Role $name)
    {
        return [
            'id'   => $name->getRouteKey(),
            'name' => $name->name,
        ];
    }
}
