<?php

namespace Litepie\Menu\Repositories\Presenter;

use League\Fractal\TransformerAbstract;

class MenuListTransformer extends TransformerAbstract
{
    public function transform(\Litepie\Menu\Models\Menu $page)
    {
        return [
            'id'    => $page->getRouteKey(),
            'key'   => $page->key,
            'name'  => $page->name,
            'order' => $page->order,
        ];
    }
}
