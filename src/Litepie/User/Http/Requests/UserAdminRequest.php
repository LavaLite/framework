<?php

namespace Litepie\User\Http\Requests;

use App\Http\Requests\Request;
use User;

class UserAdminRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(\Illuminate\Http\Request $request)
    {
        $user = $this->route('user');

        // Determine if the user is authorized to create an entry,
        if ($request->isMethod('POST') || $request->is('*/create')) {
            return User::can('user.user.create');
        }

        // Determine if the user is authorized to update an entry,
        if ($request->isMethod('PUT') || $request->isMethod('PATCH') || $request->is('*/edit')) {
            return User::can('user.user.edit');
        }

        // Determine if the user is authorized to delete an entry,
        if ($request->isMethod('DELETE')) {
            return User::can('user.user.delete');
        }

        // Determine if the user is authorized to view the module.
        return User::can('user.user.view');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(\Illuminate\Http\Request $request)
    {
        $user = $this->route('user');
        // validation rule for create request.
        if ($request->isMethod('POST')) {
            return [
                'name'     => 'required|max:255',
                'email'    => 'required|email|max:255|unique:users',
                'password' => 'required|min:6',
            ];
        }

        // Validation rule for update request.
        if ($request->isMethod('PUT') || $request->isMethod('PATCH')) {
            return [
                'name'  => 'required|max:255',
                'email' => 'required|email|max:255|unique:users,email,'.$user->id,
            ];
        }

        // Default validation rule.
        return [

        ];
    }
}
