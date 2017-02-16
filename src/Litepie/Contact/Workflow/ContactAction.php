<?php

namespace Litepie\Contact\Workflow;

use Exception;
use Litepie\Workflow\Exceptions\WorkflowActionNotPerformedException;

use Litepie\Contact\Models\Contact;

class ContactAction
{
    /**
     * Perform the complete action.
     *
     * @param Contact $contact
     *
     * @return Contact
     */
    public function complete(Contact $contact)
    {
        try {
            $contact->status = 'complete';
            return $contact->save();
        } catch (Exception $e) {
            throw new WorkflowActionNotPerformedException();
        }
    }

    /**
     * Perform the verify action.
     *
     * @param Contact $contact
     *
     * @return Contact
     */public function verify(Contact $contact)
    {
        try {
            $contact->status = 'verify';
            return $contact->save();
        } catch (Exception $e) {
            throw new WorkflowActionNotPerformedException();
        }
    }

    /**
     * Perform the approve action.
     *
     * @param Contact $contact
     *
     * @return Contact
     */public function approve(Contact $contact)
    {
        try {
            $contact->status = 'approve';
            return $contact->save();
        } catch (Exception $e) {
            throw new WorkflowActionNotPerformedException();
        }
    }

    /**
     * Perform the publish action.
     *
     * @param Contact $contact
     *
     * @return Contact
     */public function publish(Contact $contact)
    {
        try {
            $contact->status = 'publish';
            return $contact->save();
        } catch (Exception $e) {
            throw new WorkflowActionNotPerformedException();
        }
    }

    /**
     * Perform the archive action.
     *
     * @param Contact $contact
     *
     * @return Contact
     */
    public function archive(Contact $contact)
    {
        try {
            $contact->status = 'archive';
            return $contact->save();
        } catch (Exception $e) {
            throw new WorkflowActionNotPerformedException();
        }
    }

    /**
     * Perform the unpublish action.
     *
     * @param Contact $contact
     *
     * @return Contact
     */
    public function unpublish(Contact $contact)
    {
        try {
            $contact->status = 'unpublish';
            return $contact->save();
        } catch (Exception $e) {
            throw new WorkflowActionNotPerformedException();
        }
    }
}
