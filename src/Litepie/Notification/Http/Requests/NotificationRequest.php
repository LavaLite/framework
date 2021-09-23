<?php

namespace Litepie\Notification\Http\Requests;

use Litepie\Notification\Http\Requests\Request as FormRequest;

class NotificationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->model = $this->route('notification');

        if (is_null($this->model)) {
            // Determine if the user is authorized to access notification module,
            return $this->canAccess();
        }

        if ($this->isWorkflow()) {
            // Determine if the user is authorized to change status of an entry,
            return $this->can($this->getStatus());
        }

        if ($this->isCreate() || $this->isStore()) {
            // Determine if the user is authorized to create an entry,
            return $this->can('create');
        }

        if ($this->isEdit() || $this->isUpdate()) {
            // Determine if the user is authorized to update an entry,
            return $this->can('update');
        }

        if ($this->isDelete()) {
            // Determine if the user is authorized to delete an entry,
            return $this->can('delete');
        }

        // Determine if the user is authorized to view the module.
        return $this->can('view');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->isStore()) {
            // validation rule for create request.
            return [

            ];
        }

        if ($this->isUpdate()) {
            // Validation rule for update request.
            return [

            ];
        }

        // Default validation rule.
        return [

        ];
    }

    /**
     * Check whether the user can access the module.
     *
     * @return bool
     **/
    protected function canAccess()
    {
        if ($this->formRequest->user()->isAdmin() || $this->formRequest->user()->isUser()) {
            return true;
        }

        return $this->formRequest->user()->canDo('alerts.notification.view');
    }
}
