<?php

namespace Litepie\Menu\Repositories\Eloquent\Presenters;

use Litepie\Repository\Presenter\Presenter;

class MenuItemPresenter extends Presenter
{
    public function itemLink()
    {
        return guard_url('menu/menu').'/'.$this->getRouteKey();
    }

    public function toArray()
    {
        return [
            'id'           => $this->getRouteKey(),
            'parent_id'    => $this->parent_id,
            'key'          => $this->key,
            'url'          => $this->url,
            'icon'         => $this->icon,
            'permission'   => $this->permission,
            'role'         => $this->role,
            'name'         => $this->name,
            'description'  => $this->description,
            'target'       => $this->target,
            'order'        => $this->order,
            'uload_folder' => $this->uload_folder,
            'created_at'   => !is_null($this->created_at) ? $this->created_at->format('Y-m-d H:i:s') : null,
            'updated_at'   => !is_null($this->updated_at) ? $this->updated_at->format('Y-m-d H:i:s') : null,
            'meta'         => [
                'exists'     => $this->exists(),
                'link'       => $this->itemLink(),
                'upload_url' => $this->getUploadURL(''),
            ],
        ];
    }
}
