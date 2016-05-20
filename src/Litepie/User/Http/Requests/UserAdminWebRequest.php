<?php

namespace Litepie\User\Http\Requests;

use App\Http\Requests\Request;

class UserAdminWebRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(\Illuminate\Http\Request $request)
    {
        $user = $this->route('user');

        if ($request->isMethod('POST') || $request->is('*/create')) {
            // Determine if the user is authorized to create an entry.
            return $request->user('admin.web')->canDo('user.user.create');
        }

        if ($request->isMethod('PUT') || $request->isMethod('PATCH') || $request->is('*/edit')) {
            // Determine if the user is authorized to update an entry.
            return $request->user('admin.web')->canDo('user.user.edit');
        }

        if ($request->isMethod('DELETE')) {
            // Determine if the user is authorized to delete an entry.
            return $request->user('admin.web')->canDo('user.user.delete');
        }

        // Determine if the user is authorized to view the module.
        return $request->user('admin.web')->canDo('user.user.view');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(\Illuminate\Http\Request $request)
    {
        $user = $this->route('user');

        if ($request->isMethod('POST')) {
            // validation rule for create request.
            return [
                'name'     => 'required|max:255',
                'email'    => 'required|email|max:255|unique:users',
                'password' => 'required|min:6',
            ];
        }

        if ($request->isMethod('PUT') || $request->isMethod('PATCH')) {
            // Validation rule for update request.
            return [
                'name'  => 'required|max:255',
                'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            ];
        }

        // Default validation rule.
        return [

        ];
    }

}
