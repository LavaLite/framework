<?php

namespace Litepie\Contact\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Litepie\Contact\Models\Contact;

class ContactPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the given user can view the contact.
     *
     * @param User $user
     * @param Contact $contact
     *
     * @return bool
     */
    public function view(User $user, Contact $contact)
    {
        if ($user->canDo('contact.contact.view') && $user->is('admin')) {
            return true;
        }

        return $user->id === $contact->user_id;
    }

    /**
     * Determine if the given user can create a contact.
     *
     * @param User $user
     * @param Contact $contact
     *
     * @return bool
     */
    public function create(User $user)
    {
        return  $user->canDo('contact.contact.create');
    }

    /**
     * Determine if the given user can update the given contact.
     *
     * @param User $user
     * @param Contact $contact
     *
     * @return bool
     */
    public function update(User $user, Contact $contact)
    {
        if ($user->canDo('contact.contact.update') && $user->is('admin')) {
            return true;
        }

        return $user->id === $contact->user_id;
    }

    /**
     * Determine if the given user can delete the given contact.
     *
     * @param User $user
     * @param Contact $contact
     *
     * @return bool
     */
    public function destroy(User $user, Contact $contact)
    {
        if ($user->canDo('contact.contact.delete') && $user->is('admin')) {
            return true;
        }

        return $user->id === $contact->user_id;
    }

    /**
     * Determine if the user can perform a given action ve.
     *
     * @param [type] $user    [description]
     * @param [type] $ability [description]
     *
     * @return [type] [description]
     */
    public function before($user, $ability)
    {
        if ($user->isSuperUser()) {
            return true;
        }
    }
}
