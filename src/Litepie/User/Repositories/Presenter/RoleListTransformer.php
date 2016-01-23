<?php

namespace Lavalite\User\Repositories\Presenter;

use League\Fractal\TransformerAbstract;
use Hashids;

class RoleListTransformer extends TransformerAbstract
{
    public function transform(\Litepie\User\Models\Role $page)
    {
        return [
            'id' => $page->eid,
            'name' => $page->name,
        ];
    }
}


