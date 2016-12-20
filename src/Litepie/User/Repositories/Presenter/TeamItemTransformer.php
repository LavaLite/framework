<?php

namespace Litepie\User\Repositories\Presenter;

use League\Fractal\TransformerAbstract;
use Hashids;

class TeamItemTransformer extends TransformerAbstract
{
    public function transform(\Litepie\User\Models\Team $team)
    {
        return [
            'id'                => $team->getRouteKey(),
            'name'              => $team->name,
            'description'       => $team->description,
            'settings'          => $team->settings,
            'status'            => trans('app.'.$team->status),
            'created_at'        => format_date($team->created_at),
            'updated_at'        => format_date($team->updated_at),
        ];
    }
}