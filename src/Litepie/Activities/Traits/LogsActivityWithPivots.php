<?php

namespace Litepie\Activities\Traits;

use Illuminate\Database\Eloquent\Model;
use Litepie\Activities\LogOptions;
use Litepie\Activities\Traits\PivotEventTrait;
use Spatie\Activitylog\ActivityLogger;
use Spatie\Activitylog\Traits\LogsActivity as SpatieLogsActivity;
use Spatie\Activitylog\EventLogBag;
use Illuminate\Pipeline\Pipeline;

trait LogsActivityWithPivots
{
    use SpatieLogsActivity, PivotEventTrait;

    protected static function bootLogsActivityWithPivots()
    {
        
        static::eventsToBeRecorded()->each(function ($eventName) {
            if ($eventName === 'updated') {
                static::updating(function (Model $model) {
                    $oldValues = (new static())->setRawAttributes($model->getRawOriginal());
                    $model->oldAttributes = static::logChanges($oldValues);
                });
            }

            static::$eventName(function (Model $model) use ($eventName) {
                $model->activitylogOptions = $model->getActivitylogOptions();

                if (! $model->shouldLogEvent($eventName)) {
                    return;
                }

                $changes = $model->attributeValuesToBeLogged($eventName);

                $description = $model->getDescriptionForEvent($eventName);

                $logName = $model->getLogNameToUse();

                // Submitting empty description will cause place holder replacer to fail.
                if ($description == '') {
                    return;
                }

                if ($model->isLogEmpty($changes) && ! $model->activitylogOptions->submitEmptyLogs) {
                    return;
                }

                // User can define a custom pipelines to mutate, add or remove from changes
                // each pipe receives the event carrier bag with changes and the model in
                // question every pipe should manipulate new and old attributes.
                $event = app(Pipeline::class)
                ->send(new EventLogBag($eventName, $model, $changes, $model->activitylogOptions))
                ->through(static::$changesPipes)
                ->thenReturn();

                // Actual logging
                $logger = app(ActivityLogger::class)
                    ->useLog($logName)
                    ->event($eventName)
                    ->performedOn($model)
                    ->withProperties($event->changes);

                if (method_exists($model, 'tapActivity')) {
                    $logger->tap([$model, 'tapActivity'], $eventName);
                }

                $logger->log($description);

                // Reset log options so the model can be serialized.
                $model->activitylogOptions = null;
            });
        });

        collect(['pivotAttached', 'pivotDetached', 'pivotUpdated'])->each(function ($eventName) {
            return static::$eventName(function (Model $model, $relationName, $pivotIds, $pivotIdsAttributes) use ($eventName) {
                $logger = app(ActivityLogger::class)->useLog($model->getLogNameToUse($eventName));

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
