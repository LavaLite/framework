<?php

namespace Litepie\User\Repositories\Presenter;

use League\Fractal\TransformerAbstract;
use Hashids;

class NotificationListTransformer extends TransformerAbstract
{
    public function transform(\App\User $notification)
    {
        return [
            'id'                => $notification->getRouteKey(),
            'name'              => $notification->name,
            'type'              => $notification->type,
            'action'            => $notification->action,
            'read_at'           => format_date_time($notification->read_at),
            'created_at'        => format_date_time($notification->created_at),
        ];
    }
}