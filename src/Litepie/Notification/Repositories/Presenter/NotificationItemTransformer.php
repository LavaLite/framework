<?php

namespace Litepie\Notification\Repositories\Presenter;

use League\Fractal\TransformerAbstract;

class NotificationItemTransformer extends TransformerAbstract
{
    public function transform(\Litepie\Notification\Models\Notification $notification)
    {
        return [
            'id'                => $notification->getRouteKey(),
            'type'              => $notification->type,
            'notifiable_id'     => $notification->notifiable_id,
            'notifiable_type'   => $notification->notifiable_type,
            'data'              => $notification->data,
            'read_at'           => $notification->read_at,
            'status'            => trans('app.'.$notification->status),
            'created_at'        => format_date($notification->created_at),
            'updated_at'        => format_date($notification->updated_at),
        ];
    }
}
