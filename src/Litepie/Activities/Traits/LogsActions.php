<?php

namespace Litepie\Activities\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Arr;
use Litepie\Activities\ActionLogger;
use Litepie\Activities\ActivitiesServiceProvider;

trait LogsActions
{
    protected $enableActionsLogging = true;

    protected $actionAttributesForLogging = ['status', 'substatus', 'stage'];

    protected $actionAttributeToTrackLogging = ['status', 'stage'];

    protected static function bootLogsActions()
    {
        return static::updated(function (Model $model) {
            if (!$model->isActionPerformedForLogging()) {
                return;
            }

            $name = $action = $model->getActionLogName();
            $description = $model->getActionLogDescription();

            $attrs = $model->attributeValuesForActions();

            $logger = app(ActionLogger::class)
                ->performAction($action)
                ->useLog($name)
                ->performedOn($model)
                ->withProperties($attrs);
            $logger->log($description);
        });
    }

    public function isActionPerformedForLogging(): bool
    {
        return $this->isDirty($this->actionAttributeToTrackLogging);
    }

    public function attributeValuesForActions(): array
    {
        return Arr::only($this->getDirty(), $this->actionAttributesForLogging);
    }

    public function actions(): MorphMany
    {
        return $this->morphMany(ActivitiesServiceProvider::determineActionModel(), 'subject');
    }

    public function getActionLogDescription(): string
    {
        $attris = $this->only($this->actionAttributeToTrackLogging);

        return trim(implode('-', $attris), '-');
    }

    public function getActionLogName(): string
    {
        $attris = $this->only($this->actionAttributeToTrackLogging);

        return trim(implode('-', $attris), '-');
    }
}
