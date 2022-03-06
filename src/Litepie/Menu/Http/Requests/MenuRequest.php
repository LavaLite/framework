<?php

namespace Litepie\Menu\Http\Requests;

use Litepie\Http\Request\AbstractRequest;

class MenuRequest extends AbstractRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->model = $this->route('menu');

        if (is_null($this->model)) {
            // Determine if the user is authorized to access menu module,
            return $this->user()->can('view', app(config('menu.menu.model.repository')));
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
            return $this->can('destroy');
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
                // 'name'  => 'required',
                // 'url'   => 'required'
            ];
        }

        if ($this->isUpdate()) {
            // Validation rule for update request.
            return [
                // 'name'  => 'required',
                // 'url'   => 'required'
            ];
        }

        // Default validation rule.
        return [

        ];
    }
}
