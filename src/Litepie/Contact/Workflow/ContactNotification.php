<?php

namespace Litepie\Contact\Workflow;

use Litepie\Contact\Models\Contact;
use Litepie\Contact\Notifications\Contact as ContactNotifyer;
use Notification;

class ContactNotification
{

    /**
     * Send the notification to the users after complete.
     *
     * @param Contact $contact
     *
     * @return void
     */
    public function complete(Contact $contact)
    {
        return Notification::send($contact->user, new ContactNotifyer($contact, 'complete'));;
    }

    /**
     * Send the notification to the users after verify.
     *
     * @param Contact $contact
     *
     * @return void
     */
    public function verify(Contact $contact)
    {
        return Notification::send($contact->user, new ContactNotifyer($contact, 'verify'));;
    }

    /**
     * Send the notification to the users after approve.
     *
     * @param Contact $contact
     *
     * @return void
     */
    public function approve(Contact $contact)
    {
        return Notification::send($contact->user, new ContactNotifyer($contact, 'approve'));;

    }

    /**
     * Send the notification to the users after publish.
     *
     * @param Contact $contact
     *
     * @return void
     */
    public function publish(Contact $contact)
    {
        return Notification::send($contact->user, new ContactNotifyer($contact, 'publish'));;
    }

    /**
     * Send the notification to the users after archive.
     *
     * @param Contact $contact
     *
     * @return void
     */
    public function archive(Contact $contact)
    {
        return Notification::send($contact->user, new ContactNotifyer($contact, 'archive'));;

    }

    /**
     * Send the notification to the users after unpublish.
     *
     * @param Contact $contact
     *
     * @return void
     */
    public function unpublish(Contact $contact)
    {
        return Notification::send($contact->user, new ContactNotifyer($contact, 'unpublish'));;

    }
}
