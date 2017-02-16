<?php

namespace Litepie\Contact\Workflow;

use Litepie\Contact\Models\Contact;
use Validator;

class ContactValidator
{

    /**
     * Determine if the given contact is valid for complete status.
     *
     * @param Contact $contact
     *
     * @return bool / Validator
     */
    public function complete(Contact $contact)
    {
        return Validator::make($contact->toArray(), [
            'title' => 'required|min:15',
        ]);
    }

    /**
     * Determine if the given contact is valid for verify status.
     *
     * @param Contact $contact
     *
     * @return bool / Validator
     */
    public function verify(Contact $contact)
    {
        return Validator::make($contact->toArray(), [
            'title'  => 'required|min:15',
            'status' => 'in:complete',
        ]);
    }

    /**
     * Determine if the given contact is valid for approve status.
     *
     * @param Contact $contact
     *
     * @return bool / Validator
     */
    public function approve(Contact $contact)
    {
        return Validator::make($contact->toArray(), [
            'title'  => 'required|min:15',
            'status' => 'in:verify',
        ]);

    }

    /**
     * Determine if the given contact is valid for publish status.
     *
     * @param Contact $contact
     *
     * @return bool / Validator
     */
    public function publish(Contact $contact)
    {
        return Validator::make($contact->toArray(), [
            'title'       => 'required|min:15',
            'description' => 'required|min:50',
            'status'      => 'in:approve,archive,unpublish',
        ]);

    }

    /**
     * Determine if the given contact is valid for archive status.
     *
     * @param Contact $contact
     *
     * @return bool / Validator
     */
    public function archive(Contact $contact)
    {
        return Validator::make($contact->toArray(), [
            'title'       => 'required|min:15',
            'description' => 'required|min:50',
            'status'      => 'in:approve,publish,unpublish',
        ]);

    }

    /**
     * Determine if the given contact is valid for unpublish status.
     *
     * @param Contact $contact
     *
     * @return bool / Validator
     */
    public function unpublish(Contact $contact)
    {
        return Validator::make($contact->toArray(), [
            'title'       => 'required|min:15',
            'description' => 'required|min:50',
            'status'      => 'in:publish',
        ]);

    }
}
