<?php

namespace Litepie\Roles\Repositories\Eloquent\Presenters;

use Litepie\Repository\Presenter\Presenter;

class PermissionItemPresenter extends Presenter
{
    public function itemLink()
    {
        return guard_url('role/permission').'/'.$this->getRouteKey();
    }

    public function title()
    {
        if ($this->title != '') {
            return $this->title;
        }

        if ($this->name != '') {
            return $this->name;
        }

        return 'None';
    }

    public function toArray()
    {
        return [
            'id'          => $this->getRouteKey(),
            'title'       => $this->title(),
            'name'        => $this->name,
            'slug'        => $this->slug,
            'description' => $this->description,
            'created_at'  => !is_null($this->created_at) ? $this->created_at->format('Y-m-d H:i:s') : null,
            'updated_at'  => !is_null($this->updated_at) ? $this->updated_at->format('Y-m-d H:i:s') : null,
            'meta'        => [
                'exists'     => $this->exists(),
                'link'       => $this->itemLink(),
                'upload_url' => $this->getUploadURL(''),
            ],
        ];
    }
}
