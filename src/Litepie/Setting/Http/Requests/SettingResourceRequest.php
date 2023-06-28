<?php

namespace Litepie\Setting\Http\Requests;

use Litepie\Http\Request\AbstractRequest;

class SettingResourceRequest extends AbstractRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->model = $this->route('setting');

        if (is_null($this->model)) {
            // Determine if the user is authorized to access setting module,
            return $this->user()->can('view', app(config('setting.setting.model.model')));
        }

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

}
