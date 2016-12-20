<?php

namespace Litepie\Message\Repositories\Presenter;

use League\Fractal\TransformerAbstract;
use Hashids;

class MessageItemTransformer extends TransformerAbstract
{
    public function transform(\Litepie\Message\Models\Message $message)
    {
        return [
            'id'                => $message->getRouteKey(),
            'status'            => $message->status,
            'star'              => $message->star,
            'from'              => $message->from,
            'to'                => $message->to,
            'subject'           => $message->subject,
            'message'           => $message->message,
            'read'              => $message->read,
            'type'              => $message->type,
        ];
    }
}