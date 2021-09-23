<?php

namespace Litepie\User\Policies;

use Litepie\User\Interfaces\ClientRepositoryInterface;
use Litepie\User\Interfaces\UserPolicyInterface;

class ClientPolicy
{
    /**
     * Determine if the given user can view the client.
     *
     * @param UserPolicyInterface       $authUser
     * @param ClientRepositoryInterface $client
     *
     * @return bool
     */
    public function view(UserPolicyInterface $authUser, ClientRepositoryInterface $client)
    {
        return false;
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
        return false;
    }

    /**
     * Determine if the given user can update the given client.
     *
     * @param UserPolicyInterface       $authUser
     * @param ClientRepositoryInterface $client
     *
     * @return bool
     */
    public function update(UserPolicyInterface $authUser, ClientRepositoryInterface $client)
    {
        return false;
    }

    /**
     * Determine if the given user can delete the given client.
     *
     * @param UserPolicyInterface $authUser
     *
     * @return bool
     */
    public function destroy(UserPolicyInterface $authUser, ClientRepositoryInterface $client)
    {
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
