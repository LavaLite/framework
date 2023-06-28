<?php

namespace Litepie\Log\Traits;

use Illuminate\Database\Eloquent\Model;
use Litepie\Log\LogOptions;
use Litepie\Log\Traits\PivotEventTrait;
use Spatie\Activitylog\ActivityLogger;
use Spatie\Activitylog\Traits\LogsActivity as SpatieLogsActivity;

trait LogsActivityWithPivots
{
    use SpatieLogsActivity, PivotEventTrait;

    protected static function bootLogsActivityWithPivots()
    {
        collect(['pivotAttached', 'pivotDetached', 'pivotUpdated'])->each(function ($eventName) {
            return static::$eventName(function (Model $model, $relationName, $pivotIds, $pivotIdsAttributes) use ($eventName) {
                $model->activitylogOptions = $model->getActivitylogOptions();
                $logger = app(ActivityLogger::class)
                    ->useLog($model->getLogNameToUse($eventName));

                foreach ($pivotIds as $pivotId) {
                    $properties = [
                        'relationName' => $relationName,
                        'pivot_id' => $pivotId,
                        'pivotData' => empty($pivotIdsAttributes[$pivotId]) ? [] : $pivotIdsAttributes[$pivotId],
                    ];

                    $logger->performedOn($model)->withProperties($properties);

                    if (method_exists($model, 'tapActivity')) {
                        $logger->tap([$model, 'tapActivity'], $eventName);
                    }

                    $logger->log($model->getDescriptionForEvent($eventName));
                }
            });
        });
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }
}
