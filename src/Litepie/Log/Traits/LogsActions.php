<?php

namespace Litepie\Log\Traits;

use Litepie\Log\ActionLogger;

trait LogsActions
{

    protected $actionDescriptionAttributes = ['comment', 'description'];
    protected $actionAttributes = ['action', 'transition', 'actions', 'report', 'exim'];
    protected $actionExceptAttributes = ['_method'];

    protected function logsAction()
    {
        $model = $this->model;

        $action = $this->action();

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

    public function action(): string
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

    public function property(): string
    {
        $attris = request()->except($this->actionExceptAttributes);
        return json_encode($attris);
    }
}
