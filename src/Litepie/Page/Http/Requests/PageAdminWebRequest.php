<?php

namespace Litepie\Page\Http\Requests;

use App\Http\Requests\Request;

class PageAdminWebRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(\Illuminate\Http\Request $request)
    {
        $page = $this->route('page');

        if (is_null($page)) {
            // Determine if the user is authorized to access page module,
            return $request->user('admin.web')->canDo('page.page.view');
        }

        if ($request->isMethod('POST') || $request->is('*/create')) {
            // Determine if the user is authorized to create an entry,
            return $request->user('admin.web')->can('create', $page);
        }

        if ($request->isMethod('PUT') || $request->isMethod('PATCH') || $request->is('*/edit')) {
            // Determine if the user is authorized to update an entry,
            return $request->user('admin.web')->can('update', $page);
        }

        if ($request->isMethod('DELETE')) {
            // Determine if the user is authorized to delete an entry,
            return $request->user('admin.web')->can('delete', $page);
        }

        // Determine if the user is authorized to view the module.
        return $request->user('admin.web')->can('view', $page);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(\Illuminate\Http\Request $request)
    {

        if ($request->isMethod('POST')) {
            // validation rule for create request.
            return [
                'name'    => 'required',
                'content' => 'required',
            ];
        }

        if ($request->isMethod('PUT') || $request->isMethod('PATCH')) {
            // Validation rule for update request.
            return [
                'name' => 'required',
            ];
        }

        // Default validation rule.
        return [

        ];
    }

}
