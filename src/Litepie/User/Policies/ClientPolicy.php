<?php

namespace Litepie\User\Policies;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Litepie\User\Models\Client;

class ClientPolicy
{


    /**
     * Determine if the given user can view the client.
     *
     * @param Authenticatable $user
     * @param Client $client
     *
     * @return bool
     */
    public function view(Authenticatable $user, Client $client)
    {
        if ($user->canDo('user.client.view') && $user->isAdmin()) {
            return true;
        }

        return $client->user_id == user_id() && $client->user_type == user_type();
    }

    /**
     * Determine if the given user can create a client.
     *
     * @param Authenticatable $user
     *
     * @return bool
     */
    public function create(Authenticatable $user)
    {
        return  $user->canDo('user.client.create');
    }

    /**
     * Determine if the given user can update the given client.
     *
     * @param Authenticatable $user
     * @param Client $client
     *
     * @return bool
     */
    public function update(Authenticatable $user, Client $client)
    {
        if ($user->canDo('user.client.edit') && $user->isAdmin()) {
            return true;
        }

        return $client->user_id == user_id() && $client->user_type == user_type();
    }

    /**
     * Determine if the given user can delete the given client.
     *
     * @param Authenticatable $user
     *
     * @return bool
     */
    public function destroy(Authenticatable $user, Client $client)
    {
        return $client->user_id == user_id() && $client->user_type == user_type();
    }

    /**
     * Determine if the given user can verify the given client.
     *
     * @param Authenticatable $user
     *
     * @return bool
     */
    public function verify(Authenticatable $user, Client $client)
    {
        if ($user->canDo('user.client.verify')) {
            return true;
        }

        return false;
    }

    /**
     * Determine if the given user can approve the given client.
     *
     * @param Authenticatable $user
     *
     * @return bool
     */
    public function approve(Authenticatable $user, Client $client)
    {
        if ($user->canDo('user.client.approve')) {
            return true;
        }

        return false;
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
        if ($user->isSuperuser()) {
            return true;
        }
    }
}
