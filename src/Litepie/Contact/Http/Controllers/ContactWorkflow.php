<?php

namespace Litepie\Contact\Http\Controllers;
use Litepie\Contact\Http\Requests\ContactRequest;
use Litepie\Contact\Models\Contact;

trait ContactWorkflow {
	
    /**
     * Workflow controller function for contact.
     *
     * @param Model   $contact
     * @param step    next step for the workflow.
     *
     * @return Response
     */

    public function putWorkflow(ContactRequest $request, Contact $contact, $step)
    {

        try {

            $contact->updateWorkflow($step);

            return response()->json([
                'message'  => trans('messages.success.changed', ['Module' => trans('contact::contact.name'), 'status' => trans("app.{$step}")]),
                'code'     => 204,
                'redirect' => trans_url('/admin/contact/contact/' . $contact->getRouteKey()),
            ], 201);

        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 400,
                'redirect' => trans_url('/admin/contact/contact/' . $contact->getRouteKey()),
            ], 400);

        }

    }

    /**
     * Workflow controller function for contact.
     *
     * @param Model   $contact
     * @param step    next step for the workflow.
     * @param user    encrypted user id.
     *
     * @return Response
    */

    public function getWorkflow(Contact $contact, $step, $user)
    {
        try {
            $user_id = decrypt($user);

            Auth::onceUsingId($user_id);

            $contact->updateWorkflow($step);

            $data = [
                'message' => trans('messages.success.changed', ['Module' => trans('contact::contact.name'), 'status' => trans("app.{$step}")]),
                'status'  => 'success',
                'step'    => trans("app.{$step}"),
            ];

            return $this->theme->layout('blank')->of('contact::admin.contact.message', $data)->render();

        } catch (ValidationException $e) {

            $data = [
                'message' => '<b>' . $e->getMessage() . '</b> <br /><br />' . implode('<br />', $e->validator->errors()->all()),
                'status'  => 'error',
                'step'    => trans("app.{$step}"),
            ];

            return $this->theme->layout('blank')->of('contact::admin.contact.message', $data)->render();

        } catch (Exception $e) {

            $data = [
                'message' => '<b>' . $e->getMessage(). '</b>',
                'status'  => 'error',
                'step'    => trans("app.{$step}"),
            ];

            return $this->theme->layout('blank')->of('contact::admin.contact.message', $data)->render();

        }

    }
}