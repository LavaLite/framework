<?php

namespace Litepie\Block\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Litepie\Block\Models\Block;

class BlockPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the given user can view the block.
     *
     * @param User $user
     * @param Block $block
     *
     * @return bool
     */
    public function view(User $user, Block $block)
    {

        if ($user->canDo('block.block.view') && $user->is('admin')) {
            return true;
        }

        return $user->id === $block->user_id;
    }

    /**
     * Determine if the given user can create a block.
     *
     * @param User $user
     * @param Block $block
     *
     * @return bool
     */
    public function create(User $user)
    {
        return $user->canDo('block.block.create');
    }

    /**
     * Determine if the given user can update the given block.
     *
     * @param User $user
     * @param Block $block
     *
     * @return bool
     */
    public function update(User $user, Block $block)
    {

        if ($user->canDo('block.block.update') && $user->is('admin')) {
            return true;
        }

        return $user->id === $block->user_id;
    }

    /**
     * Determine if the given user can delete the given block.
     *
     * @param User $user
     * @param Block $block
     *
     * @return bool
     */
    public function destroy(User $user, Block $block)
    {

        if ($user->canDo('block.block.delete') && $user->is('admin')) {
            return true;
        }

        return $user->id === $block->user_id;
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
