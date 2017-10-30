<?php

namespace Litepie\Calendar\Repositories\Presenter;

use League\Fractal\TransformerAbstract;
use Hashids;

class CalendarItemTransformer extends TransformerAbstract
{
    public function transform(\Litepie\Calendar\Models\Calendar $calendar)
    {
        return [
            'id'                => $calendar->getRouteKey(),
            'category_id'       => $calendar->category_id,
            'status'            => $calendar->status,
            'start'             => date_time_format($calendar->start),
            'end'               => date_time_format($calendar->end),
            'location'          => $calendar->location,
            'color'             => $calendar->color,
            'title'             => $calendar->title,
            'details'           => $calendar->details,
            'created_by'        => $calendar->created_by,
        ];
    }
}