<?php

namespace Litepie\Http\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request as IlluminateRequest;

abstract class AbstractRequest extends FormRequest
{
    /**
     * User for the current request.
     *
     * @var object|array
     */
    protected $formRequest;

    /* Model for the current request.
     *
     * @var array
     */
    protected $model;

    /**
     * Constructor.
     *
     * @return void
     *
     * @author
     **/
    public function __construct(IlluminateRequest $request)
    {
        $this->formRequest = $request;
    }

    /**
     * Check the proess is approve.
     *
     * @return bool
     **/
    protected function can($action)
    {
        return $this->formRequest->user()->can($action, $this->model);
    }

    /**
     * Check the proess is verify.
     *
     * @return bool
     **/
    protected function canAccess()
    {
        if ($this->formRequest->user()->isSuperuser()) {
            return true;
        }
    }

    /**
     * Check the proess is verify.
     *
     * @return bool
     **/
    protected function isWorkflow()
    {
        if ($this->formRequest->isMethod('PATCH')
            && $this->formRequest->transition !== '') {
            return true;
        }

        return false;
    }

    /**
     * Get transitions from the url
     *
     * @return string|null
     */
    protected function getTransition()
    {
        return $this->formRequest->transition;
    }

    /**
     * Get action from the url
     *
     * @return string|null
     */
    protected function getAction()
    {
        return $this->formRequest->action;
    }

    /**
     * Get action from the url
     *
     * @return string|null
     */
    protected function getReport()
    {
        return $this->formRequest->report;
    }

    /**
     * Check the proess is verify.
     *
     * @return bool
     **/
    protected function isCreate()
    {
        if ($this->formRequest->is('*/create')) {
            return true;
        }

        return false;
    }

    /**
     * Check the proess is store.
     *
     * @return bool
     **/
    protected function isStore()
    {
        if ($this->formRequest->isMethod('POST')) {
            return true;
        }

        return false;
    }

    /**
     * Check the proess is store.
     *
     * @return bool
     **/
    protected function isExport()
    {
        if ($this->formRequest->is('*/export')) {
            return true;
        }

        return false;
    }

    /**
     * Check the proess is store.
     *
     * @return bool
     **/
    protected function isImport()
    {
        if ($this->formRequest->is('*/import')) {
            return true;
        }

        return false;
    }

    /**
     * Check the proess is edit.
     *
     * @return bool
     **/
    protected function isEdit()
    {
        if (
            $this->formRequest->is('*/edit')) {
            return true;
        }

        return false;
    }

    /**
     * Check the proess is update.
     *
     * @return bool
     **/
    protected function isUpdate()
    {
        if ($this->formRequest->isMethod('PUT') ||
            $this->formRequest->isMethod('PATCH')) {
            return true;
        }

        return false;
    }

    /**
     * Check the proess is verify.
     *
     * @return bool
     **/
    protected function isDelete()
    {
        if ($this->formRequest->isMethod('DELETE')) {
            return true;
        }

        return false;
    }
}
