<?php

namespace Litepie\User\Http\Requests;

use App\Http\Requests\Request;

class RoleAdminWebRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(\Illuminate\Http\Request $request)
    {
        $role = $this->route('role');

// Determine if the user is authorized to access role role,
        if (is_null($role)) {
            return $request->user('admin.web')->canDo('package.role.view');
        }

// Determine if the user is authorized to create an entry.
        if ($request->isMethod('POST') || $request->is('*/create')) {
            return $request->user('admin.web')->can('create', $role);
        }

// Determine if the user is authorized to update an entry.
        if ($request->isMethod('PUT') || $request->isMethod('PATCH') || $request->is('*/edit')) {
            return $request->user('admin.web')->can('update', $role);
        }

// Determine if the user is authorized to delete an entry.
        if ($request->isMethod('DELETE')) {
            return $request->user('admin.web')->can('delete', $role);
        }

        // Determine if the user is authorized to view the role.
        return $request->user('admin.web')->can('view', $role);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(\Illuminate\Http\Request $request)
    {
        $role = $this->route('role');

// validation rule for create request.
        if ($request->isMethod('POST')) {
            return [
                'name' => 'required|max:50|unique:roles',
            ];
        }

// Validation rule for update request.
        if ($request->isMethod('PUT') || $request->isMethod('PATCH')) {
            return [
                //'name' => 'required|max:50|unique:roles,id,'.$role->getRouteKey()
            ];
        }

        // Default validation rule.
        return [

        ];
    }

}
