<?php

namespace Litepie\Actions\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Litepie\Actions\Models\Action;

trait Actionable
{

    public $log_action = [];

    public function actions()
    {
        return app('action')->get(self::class);
    }

    /**
     * Get all of the log history's comments.
     */
    public function actionLog(): MorphMany
    {
        return $this->morphMany(Action::class, 'subject')
            ->orderBy('id', 'DESC');
    }

    /**
     * Get the activities for the model.
     *
     * @param int $count
     * @param int $offset
     * @return array
     */
    public function getActions($count = 10, $offset = 0)
    {
        if (!$this->exists) {
            return [];
        }

        $logs = $this->actionLog->take($count);

        if (empty($logs)) {
            return [];
        }

        foreach ($logs as $key => $log) {
            $logs[$key] = [
                'id' => $log->getRouteKey(),
                'name' => __($log->action),
                'description' => __($log->description),
                'causer' => [
                    'id' => $log->causer ? $log->causer->getRouteKey() : '1',
                    'name' => $log->causer ? $log->causer->name : 'System User',
                    'picture' => $log->causer ? $log->causer->picture : url('/assets/img/avatar/male.png'),
                ],
                'properties' => $this->formatActionLog($log->properties),
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
    public function formatActionLog($properties)
    {
        if (empty($properties)) {
            return [];
        }

        $formattedLogs = [];

        foreach ($properties as $key => $property) {
            if (in_array($key, $this->log_action['exclude'])) {
                continue;
            }
            if (is_array($property)) {
                foreach ($property as $row => $item) {
                    $formattedLog = [
                        'value' => $item,
                        'label' => trans($this->log_action['label'] . $row),
                    ];

                    $formattedLog['text'] = $formattedLog['label'] . ': ' . $formattedLog['value'];

                    $formattedLogs[$row] = $formattedLog;
                }
                continue;
            }
            $formattedLog = [
                'value' => $property,
                'label' => trans($this->log_action['label'] . $key),
            ];

            $formattedLog['text'] = $formattedLog['label'] . ': ' . $formattedLog['value'];

            $formattedLogs[$key] = $formattedLog;
        }
        return $formattedLogs;
    }

    public function canDoActions($roles = [])
    {
        if ($this->team && $this->team->hasTeamRole(@$roles['team'], true)) {
            return true;
        }
        if (user()->hasRole(@$roles['user'])) {
            return true;
        }

        if (@$roles['model']) {
            foreach ($roles['model'] as $model) {
                if ($this->$model) {
                    return true;
                }
            }
        }

        return false;
    }
}
