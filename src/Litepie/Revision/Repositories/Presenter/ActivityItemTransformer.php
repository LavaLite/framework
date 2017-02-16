<?php

namespace Litepie\Revision\Repositories\Presenter;

use League\Fractal\TransformerAbstract;
use Hashids;

class ActivityItemTransformer extends TransformerAbstract
{
    public function transform(\Litepie\Revision\Models\Activity $news)
    {
        return [
            'id'                => $activity->id,
            'user_type'         => $activity->user_type,
            'user_id'           => $activity->user_id,
            'action'            => $activity->action,
            'name'              => $activity->name,
            'activity_type'     => $activity->activity_type,
            'activity_id'       => $activity->activity_id,
            'user_info'         => '<a href="#" class="text-danger valueModal" data-old="'.$activity->old_value.'" data-new="'.$activity->new_value.'"><i class="fa fa-file-text"></i></a>',
            'created_at'        => $activity->created_at->format('d M Y'),
        ];
    }
}