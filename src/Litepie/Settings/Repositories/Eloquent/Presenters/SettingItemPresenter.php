<?php

namespace Litepie\Settings\Repositories\Eloquent\Presenters;

use Litepie\Repository\Presenter\Presenter;

class SettingItemPresenter extends Presenter
{
    public function itemLink()
    {
        return guard_url('settings/setting').'/'.$this->getRouteKey();
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
            'id'            => $this->getRouteKey(),
            'title'         => $this->title(),
            'key'           => $this->key,
            'package'       => $this->package,
            'module'        => $this->module,
            'name'          => $this->name,
            'value'         => $this->value,
            'file'          => $this->file,
            'control'       => $this->control,
            'type'          => $this->type,
            'slug'          => $this->slug,
            'user_id'       => $this->user_id,
            'user_type'     => $this->user_type,
            'upload_folder' => $this->upload_folder,
            'created_at'    => !is_null($this->created_at) ? $this->created_at->format('Y-m-d H:i:s') : null,
            'updated_at'    => !is_null($this->updated_at) ? $this->updated_at->format('Y-m-d H:i:s') : null,
            'meta'          => [
                'exists'     => $this->exists(),
                'link'       => $this->itemLink(),
                'upload_url' => $this->getUploadURL(''),
            ],
        ];
    }
}
