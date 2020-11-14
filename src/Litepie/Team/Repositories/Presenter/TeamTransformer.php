<?php

namespace Litepie\Team\Repositories\Presenter;

use League\Fractal\TransformerAbstract;
use Hashids;

class TeamTransformer extends TransformerAbstract
{
    public function transform(\Litepie\Team\Models\Team $team)
    {
        return [
            'id'                => $team->getRouteKey(),
            'key'               => [
                'public'    => $team->getPublicKey(),
                'route'     => $team->getRouteKey(),
            ], 
            'name'              => $team->name,
            'url'               => [
                'public'    => trans_url('teams/'.$team->getPublicKey()),
                'user'      => guard_url('user/team/'.$team->getRouteKey()),
            ], 
            'status'            => trans('app.'.$team->status),
            'created_at'        => format_date($team->created_at),
            'updated_at'        => format_date($team->updated_at),
        ];
    }
}