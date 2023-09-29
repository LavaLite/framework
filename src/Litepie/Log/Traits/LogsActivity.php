<?php

namespace Litepie\Log\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Litepie\Log\LogOptions;
use Litepie\Log\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity as SpatieLogActivity;

trait LogsActivity
{
    use SpatieLogActivity;

    public $log_activity = [];

    public function getActivitylogOptions(): LogOptions
    {
        $fields = array_merge($this->fillable, $this->log_activity['fields']);
        return LogOptions::defaults()
            ->logOnly($fields)
            ->logOnlyDirty();
    }

    /**
     * Get all of the log history's comments.
     */
    public function activityLog(): MorphMany
    {
        return $this->morphMany(Activity::class, 'subject')
            ->orderBy('id', 'DESC');
    }

    /**
     * Get the activities for the model.
     *
     * @param int $count
     * @param int $offset
     * @return array
     */
    public function getActivities($count = 10, $offset = 0)
    {
        if (!$this->exists) {
            return [];
        }

        $logs = $this->activityLog->take($count);

        if (empty($logs)) {
            return [];
        }

        foreach ($logs as $key => $log) {
            $logs[$key] = [
                'id' => $log->getRouteKey(),
                'name' => trans($log->log_name),
                'description' => __($log->description),
                'causer' => [
                    'id' => $log->causer ? $log->causer->getRouteKey() : '1',
                    'name' => $log->causer ? $log->causer->name : 'System User',
                    'picture' => $log->causer ? $log->causer->picture : url('/assets/img/avatar/male.png'),
                ],
                'properties' => $this->formatActivityLog($log->properties),
                'created_at' => format_date_time($log->created_at),
                'updated_at' => format_date_time($log->updated_at),
            ];
        }

        return $logs;
    }

    /**
     * Format the log properties.
     *
     * @param array $properties
     * @return array
     */
    public function formatActivityLog($properties)
    {
        if (empty($properties) || !isset($properties['attributes'])) {
            return [];
        }

        $formattedLogs = [];

        foreach ($properties['attributes'] as $key => $attributes) {
            if (in_array($key, $this->log_activity['exclude'])) {
                continue;
            }

            $formattedLog = [
                'old' => @$properties['old'][$key],
                'new' => $attributes,
                'type' => 'text',
                'label' => trans($this->log_activity['label'] . $key),
            ];

            if (array_key_exists($key, $this->log_activity['casts'])) {
                $type = $this->log_activity['casts'][$key];
                if (is_callable($type)) {
                    $formattedLog = call_user_func($type, $formattedLog);
                } else {
                    $formattedLog['type'] = $type;
                }
            }

            $formattedLogs[$key] = $formattedLog;
        }

        return $formattedLogs;
    }
}
