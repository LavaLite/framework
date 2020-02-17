<?php

namespace Litepie\Activities\Repositories\Presenter;

use League\Fractal\TransformerAbstract;

class ActivityLogTransformer extends TransformerAbstract {
	public function transform(\Litepie\Activities\Models\Activity $activity) {
		return [
			'id' => $activity->getRouteKey(),
			'name' => trans($activity->log_name),
			'description' => __($activity->description),
			'subject' => [
				'id' => $activity->subject->getRouteKey(),
				'name' => $activity->subject->name,
			],
			'causer' => [
				'id' => $activity->causer->getRouteKey(),
				'name' => $activity->causer->name,
			],
			'properties' => $activity->properties,
			'created_at' => $activity->created_at,
			'updated_at' => $activity->updated_at,
			'created' => format_date($activity->created_at),
			'updated' => format_date($activity->updated_at),
		];
	}
}