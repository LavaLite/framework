<?php

namespace Litepie\Calendar\Policies;

use Litepie\Calendar\Models\Calendar;
use Litepie\User\Contracts\UserPolicy;

class CalendarPolicy
{

    /**
     * Determine if the given user can view the calendar.
     *
     * @param User $user
     * @param Calendar $calendar
     *
     * @return bool
     */
    public function view(UserPolicy $user, Calendar $calendar)
    {
        if ($user->canDo('calendar.calendar.view') && $user->hasRole('admin')) {
            return true;
        }

        if ($user->canDo('calendar.calendar.view') 
        && $user->hasRole('manager')
        && $calendar->user->parent_id == $user->id
        && get_class($user) === $user->user_type) {
            return true;
        }

        return $user->id === $calendar->user_id && get_class($user) === $calendar->user_type;
    }

    /**
     * Determine if the given user can create a calendar.
     *
     * @param User $user
     * @param Calendar $calendar
     *
     * @return bool
     */
    public function create(UserPolicy $user)
    {
        return  $user->canDo('calendar.calendar.create');
    }

    /**
     * Determine if the given user can update the given calendar.
     *
     * @param User $user
     * @param Calendar $calendar
     *
     * @return bool
     */
    public function update(UserPolicy $user, Calendar $calendar)
    {
        if ($user->canDo('calendar.calendar.update') && $user->hasRole('admin')) {
            return true;
        }

        if ($user->canDo('calendar.calendar.update') 
            && $user->hasRole('manager') 
            && $calendar->user->parent_id == $user->id
            && get_class($user) === $user->user_type) {
            return true;
        }

       return $user->id == $calendar->user_id && get_class($user) == $calendar->user_type;

    }

    /**
     * Determine if the given user can delete the given calendar.
     *
     * @param User $user
     * @param Calendar $calendar
     *
     * @return bool
     */
    public function destroy(UserPolicy $user, Calendar $calendar)
    {
        if ($user->canDo('calendar.calendar.delete') && $user->hasRole('admin')) {
            return true;
        }

        if ($user->canDo('calendar.calendar.delete') 
        && $user->hasRole('manager')
        && $calendar->user->parent_id == $user->id) {
            return true;
        }
        
        return $user->id == $calendar->user_id && get_class($user) == $calendar->user_type;
    }

    /**
     * Determine if the given user can verify the given calendar.
     *
     * @param User $user
     * @param Calendar $calendar
     *
     * @return bool
     */
    public function verify(UserPolicy $user, Calendar $calendar)
    {
        if ($user->canDo('calendar.calendar.verify') && $user->hasRole('admin')) {
            return true;
        }

        if ($user->canDo('calendar.calendar.verify') 
        && $user->hasRole('manager')
        && $calendar->user->parent_id == $user->id) {
            return true;
        }

        return false;
    }

    /**
     * Determine if the given user can approve the given calendar.
     *
     * @param User $user
     * @param Calendar $calendar
     *
     * @return bool
     */
    public function approve(UserPolicy $user, Calendar $calendar)
    {
        if ($user->canDo('calendar.calendar.approve') && $user->hasRole('admin')) {
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
    public function before(UserPolicy $user, $ability)
    {
        if ($user->hasRole('superuser')) {
            return true;
        }
    }
}
