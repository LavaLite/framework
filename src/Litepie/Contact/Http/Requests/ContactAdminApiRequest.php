<?php

namespace Litepie\Contact\Http\Requests;

use App\Http\Requests\Request as FormRequest;
use Illuminate\Http\Request;
use Gate;

class ContactAdminApiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(Request $request)
    {
        $contact = $this->route('contact');

        if (is_null($contact)) {
            // Determine if the user is authorized to access contact module,
            return $request->user('admin.api')->canDo('contact.contact.view');
        }

        if ($request->isMethod('POST') || $request->is('*/create')) {
            // Determine if the user is authorized to create an entry,
            return $request->user('admin.api')->can('create', $contact);
        }

        if ($request->isMethod('PUT') || $request->isMethod('PATCH') || $request->is('*/edit')) {
            // Determine if the user is authorized to update an entry,
            return $request->user('admin.api')->can('update', $contact);
        }

        if ($request->isMethod('DELETE')) {
            // Determine if the user is authorized to delete an entry,
            return $request->user('admin.api')->can('delete', $contact);
        }

        // Determine if the user is authorized to view the module.
        return $request->user('admin.api')->can('view', $contact);

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        if ($request->isMethod('POST')) {
            // validation rule for create request.
            return [
                
            ];
        }

        if ($request->isMethod('PUT') || $request->isMethod('PATCH')) {
            // Validation rule for update request.
            return [
                
            ];
        }

        // Default validation rule.
        return [

        ];
    }
}
