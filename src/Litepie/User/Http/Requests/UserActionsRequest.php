<?php

namespace Litepie\User\Http\Requests;

use Litepie\Http\Request\AbstractRequest;
use Litepie\user\Models\User;

class UserActionsRequest extends AbstractRequest
{
    /* Model for the current request.
     *
     * @var array
     */
    protected $action;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->model = app(User::class);
        $this->action = $this->getAction();

        // Determine if the user is authorized to perform the action.
        return $this->model->canDoAction($this->rules());
    }

    public function rules()
    {
        return config('user.user.actions.'.$this->action.'.roles', []);
    }
}
