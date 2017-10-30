<?php

namespace Litepie\Calendar;

use User;

class Calendar
{
    /**
     * $calendar object.
     */
    protected $calendar;

    /**
     * Constructor.
     */
    public function __construct(\Litepie\Calendar\Interfaces\CalendarRepositoryInterface $calendar)
    {
        $this->calendar = $calendar;
    }

    /**
     * Returns count of calendar.
     *
     * @param array $filter
     *
     * @return int
     */
    public function count($type = 'admin.web')
    {

        return $this->calendar
            ->scopeQuery(function ($query) use ($type) {
                return $query->where('status', '<>', 'Draft')
                    ->whereUserId(user_id($type))
                    ->whereUserType(user_type($type));
            })->count();
    }

    /**
     * Display Calendar of the user.
     *
     * @return void
     *
     * @author
     **/
    public function display($view, $count = 10)
    {
        $data = $this->calendar->scopeQuery(function ($query) use ($count) {
            return $query->where('status', '<>', 'Draft')->orderBy('id', 'DESC')->take($count);
        })->all();
        return view('calendar::admin.calendar.' . $view, compact('data'));
    }

    /**
     * get calendar.
     *
     * @author
     **/
    public function getCalendar()
    {
        return view('calendar::user.calendar.calendar')->render();
    }

    /**
     * Display gadget.
     *
     *
     * @param string $view
     *
     * @author
     **/
    public function gadget($view = 'admin.calendar.gadget')
    {
        $guard = getenv('auth.guard');

        return view('calendar::' . $view, compact('guard'))->render();
    }

    /**
     * Make Users list.
     * @return array
     **/
    public function users()
    {
        $list  = [];
        $users = User::all();

        foreach ($users as $key => $user) {
            $list[$user->id] = $user->name;
        }

        return $list;
    }

}
