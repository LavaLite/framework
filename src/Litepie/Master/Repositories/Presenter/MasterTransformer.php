<?php

namespace Litepie\Master\Repositories\Presenter;

use League\Fractal\TransformerAbstract;
use Hashids;

class MasterTransformer extends TransformerAbstract
{
    public function transform(\Litepie\Master\Models\Master $master)
    {
        return [
            'id'                => $master->getRouteKey(),
            'parent_id'         => @$master->parent_id,
            'type'              => $master->type,
            'name'              => $master->name,
             'level1'         => @$master->parent->name,
            'description'       => $master->description,
            'icon'              => $master->icon,
            'image'             => $master->image,
            'slug'              => $master->slug,
            'created_at'        => $master->created_at,
            'updated_at'        => $master->updated_at,
            'deleted_at'        => $master->deleted_at,
            'url'              => [
                'public' => trans_url('master/'.$master->getPublicKey()),
                'user'   => guard_url('master/master/'.$master->getRouteKey()),
            ], 
            'status'            => trans('app.'.$master->status),
            'created_at'        => format_date($master->created_at),
            'updated_at'        => format_date($master->updated_at),
        ];
    }
}