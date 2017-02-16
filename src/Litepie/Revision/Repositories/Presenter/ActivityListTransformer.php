<?php

namespace Litepie\Revision\Repositories\Presenter;

use League\Fractal\TransformerAbstract;
use Hashids;

class ActivityListTransformer extends TransformerAbstract
{
    public function transform(\Litepie\Revision\Models\Activity $activity)
    {
        return [
            'id'                => $activity->id,
            'user_type'         => $activity->user_type,
            'user_id'           => @$activity->user->name,
            'action'            => $activity->action,
            'name'              => $activity->name,
            'activity_type'     => substr(strrchr($activity->activity_type, '\\'), 1),
            'activity_id'       => $activity->activity_id,
            'user_info'         => '<a href="#" class="text-danger valueModal" data-remote="'.@$activity->user_info['remote_addr'].'" data-agent="'.@$activity->user_info['user_agent'].'"><i class="fa fa-file-text"></i></a>',
            'created_at'        => $activity->created_at->format('d M Y H:i A'),
        ];
    }
}