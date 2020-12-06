<?php

namespace Litepie\Master\Repositories\Presenter;

use League\Fractal\TransformerAbstract;

class MasterTransformer extends TransformerAbstract
{
    public function transform(\Litepie\Master\Models\Master $master)
    {
        return [
            'id'          => $master->getRouteKey(),
            'parent_id'   => @$master->parent_id,
            'type'        => $master->type,
            'code'        => $master->code,
            'name'        => $master->name,
            'parent'      => @$master->parent->name,
            'description' => $master->description,
            'abbr'        => $master->abbr,
            'icon'        => $master->icon,
            'amount'      => $master->image,
            'image'       => $master->image,
            'images'      => $master->images,
            'file'        => $master->file,
            'order'       => $master->order,
            'extras'      => $master->extras,
            'slug'        => $master->slug,
            'created_at'  => $master->created_at,
            'updated_at'  => $master->updated_at,
            'deleted_at'  => $master->deleted_at,
            'url'         => [
                'public' => trans_url('master/'.$master->getPublicKey()),
                'user'   => guard_url('master/master/'.$master->getRouteKey()),
            ],
            'status'     => $master->status,
            'created_at' => format_date($master->created_at),
            'updated_at' => format_date($master->updated_at),
        ];
    }
}
