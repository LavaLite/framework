<?php

namespace Litepie\Menu\Repositories\Presenter;

use League\Fractal\TransformerAbstract;

class MenuListTransformer extends TransformerAbstract
{
    public function transform(\Litepie\Menu\Models\Menu $menu)
    {
        return [
            'id'                => $menu->getRouteKey(),
            'parent_id'         => $menu->parent_id,
            'key'               => $menu->key,
            'url'               => $menu->url,
            'icon'              => $menu->icon,
            'permission'        => $menu->permission,
            'role'              => $menu->role,
            'name'              => $menu->name,
            'description'       => $menu->description,
            'target'            => $menu->target,
            'order'             => $menu->order,
            'uload_folder'      => $menu->uload_folder,
            'status'            => trans('app.'.$menu->status),
            'created_at'        => format_date($menu->created_at),
            'updated_at'        => format_date($menu->updated_at),
        ];
    }
}
