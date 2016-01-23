<?php

namespace Litepie\Menu\Repositories\Presenter;

use League\Fractal\TransformerAbstract;
use Hashids;

class MenuListTransformer extends TransformerAbstract
{
    public function transform(\Litepie\Menu\Models\Menu $page)
    {
        return [
            'id' => $page->eid,
            'key' => $page->key,
            'name' => $page->name,
            'order' => $page->order
        ];
    }
}