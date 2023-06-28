<?php

namespace Litepie\User\Policies;

use Litepie\User\Interfaces\UserPolicyInterface;
use Litepie\User\Models\Client;

class ClientPolicy
{


    /**
     * Determine if the given user can view the client.
     *
     * @param UserPolicyInterface $authUser
     * @param Client $client
     *
     * @return bool
     */
    public function view(UserPolicyInterface $authUser, Client $client)
    {
        if ($authUser->canDo('user.client.view') && $authUser->isAdmin()) {
            return true;
        }

        return $client->user_id == user_id() && $client->user_type == user_type();
    }

    /**
     * Determine if the given user can create a client.
     *
     * @param UserPolicyInterface $authUser
     *
     * @return bool
     */
    public function create(UserPolicyInterface $authUser)
    {
        return  $authUser->canDo('user.client.create');
    }

    /**
     * Determine if the given user can update the given client.
     *
     * @param UserPolicyInterface $authUser
     * @param Client $client
     *
     * @return bool
     */
    public function update(UserPolicyInterface $authUser, Client $client)
    {
        if ($authUser->canDo('user.client.edit') && $authUser->isAdmin()) {
            return true;
        }

        return $client->user_id == user_id() && $client->user_type == user_type();
    }

    /**
     * Determine if the given user can delete the given client.
     *
     * @param UserPolicyInterface $authUser
     *
     * @return bool
     */
    public function destroy(UserPolicyInterface $authUser, Client $client)
    {
        return $client->user_id == user_id() && $client->user_type == user_type();
    }

    /**
     * Determine if the given user can verify the given client.
     *
     * @param UserPolicyInterface $authUser
     *
     * @return bool
     */
    public function verify(UserPolicyInterface $authUser, Client $client)
    {
        if ($authUser->canDo('user.client.verify')) {
            return true;
        }

        return false;
    }

    /**
     * Determine if the given user can approve the given client.
     *
     * @param UserPolicyInterface $authUser
     *
     * @return bool
     */
    public function approve(UserPolicyInterface $authUser, Client $client)
    {
        if ($authUser->canDo('user.client.approve')) {
            return true;
        }

        return false;
    }

    /**
     * Determine if the user can perform a given action ve.
     *
     * @param [type] $authUser    [description]
     * @param [type] $ability [description]
     *
     * @return [type] [description]
     */
    public function before($authUser, $ability)
    {
        if ($authUser->isSuperuser()) {
            return true;
        }
    }
}
