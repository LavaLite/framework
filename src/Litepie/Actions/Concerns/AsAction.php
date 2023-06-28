<?php

namespace Litepie\Actions\Concerns;

use Litepie\Actions\Traits\LogsActions;
use Lorisleiva\Actions\Concerns\AsAction as AsBaseAction;
use Lorisleiva\Actions\Concerns\WithAttributes;

trait AsAction
{
    use AsBaseAction;
    use WithAttributes;
    use LogsActions;

    protected function executeAction()
    {
        // Dispatch the "before" event for the action.
        $this->dispatchActionBeforeEvent();

        // Execute the action function on the model with the request.
        $this->model = $this->{$this->function}($this->model, $this->request);

        // Dispatch the "after" event for the action.
        $this->dispatchActionAfterEvent();

        // Log the action.
        $this->logsAction();
    }

    protected function executeWorkflow()
    {
        // Dispatch the "before" event for the workflow.
        $this->dispatchWorkflowBeforeEvent();

        // Apply the workflow transition on the model with the request.
        $this->model->workflow()->apply($this->model, $this->transition);

        // Execute the action function on the model with the request.
        $this->model = $this->{$this->function}($this->model, $this->request);

        // Dispatch the "after" event for the workflow.
        $this->dispatchWorkflowAfterEvent();

        // Log the workflow.
        $this->logsWorkflow();
    }

    protected function dispatchActionBeforeEvent()
    {
        $eventClass = $this->eventClass;

        // Check if the event class is empty or does not exist.
        if (empty($eventClass) || !class_exists($eventClass)) {
            return;
        }

        $eventString = $this->action;

        // Dispatch the "before" event for the action.
        $eventClass::dispatch($eventString, $this->model, $this->request, 'before');
    }

    protected function dispatchActionAfterEvent()
    {
        $eventClass = $this->eventClass;

        // Check if the event class is empty or does not exist.
        if (empty($eventClass) || !class_exists($eventClass)) {
            return;
        }

        $eventString = $this->action;

        // Dispatch the "after" event for the action.
        $eventClass::dispatch($eventString, $this->model, $this->request);
    }

    protected function dispatchWorkflowBeforeEvent()
    {
        $eventClass = $this->eventClass;

        // Check if the event class is empty or does not exist.
        if (empty($eventClass) || !class_exists($eventClass)) {
            return;
        }

        $eventString = $this->transition;

        // Dispatch the "before" event for the workflow.
        $eventClass::dispatch($eventString, $this->model, $this->request, 'before');
    }

    protected function dispatchWorkflowAfterEvent()
    {
        $eventClass = $this->eventClass;

        // Check if the event class is empty or does not exist.
        if (empty($eventClass) || !class_exists($eventClass)) {
            return;
        }

        $eventString = $this->transition;

        // Dispatch the "after" event for the workflow.
        $eventClass::dispatch($eventString, $this->model, $this->request, 'after');
    }
}
