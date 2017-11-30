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

        if ($user->isUser() || $user->isAdmin()){
            return true;
        }

        return $user->id == $calendar->user_id && get_class($user) == $calendar->user_type;
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
        return $user->id == $calendar->user_id && get_class($user) == $calendar->user_type;
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
        if ($user->isSuperuser) {
            return true;
        }
    }
}
