<?php

namespace Litepie\Actions\Traits;

use Litepie\Actions\ActionLogger;

trait LogsActions
{
    protected $actionDescriptionAttributes = ['comment', 'description'];
    protected $actionAttributes = ['action', 'transition', 'actions', 'report', 'exim'];
    protected $actionExceptAttributes = ['_method'];

    protected function logsAction()
    {
        $model = $this->model;

        $action = $this->getLogAction();

        if (empty($action)) {
            return;
        }

        app(ActionLogger::class)
            ->action($action)
            ->on($model)
            ->by(request()->user)
            ->description($this->description())
            ->property($this->property())
            ->save();
    }

    protected function logsWorkflow()
    {
        $model = $this->model;

        $transition = $this->getLogTransition();
        if (empty($transition)) {
            return;
        }

        app(ActionLogger::class)
            ->action($transition)
            ->on($model)
            ->by(request()->user)
            ->description($this->description())
            ->property($this->property())
            ->save();
    }

    public function getLogAction(): string
    {
        $action = collect(request()->route()->parameters())
            ->only($this->actionAttributes)
            ->toArray();

        return trim(implode('-', $action), '-');
    }

    public function getLogTransition(): string
    {
        $action = collect(request()->route()->parameters())
            ->only($this->actionAttributes)
            ->toArray();

        return trim(implode('-', $action), '-');
    }

    public function description(): string
    {
        $attris = request()->only($this->actionDescriptionAttributes);

        return trim(implode(',', $attris), ',');
    }

    public function property(): array
    {
        return request()->except($this->actionExceptAttributes);
    }
}
