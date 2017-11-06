<?php

namespace Litepie\Calendar\Http\Controllers;

use App\Http\Controllers\PublicController as BaseController;
use Litepie\Calendar\Interfaces\CalendarRepositoryInterface;

class CalendarPublicController extends BaseController
{
    /**
     * Constructor.
     *
     * @param type \Litepie\Calendar\Interfaces\CalendarRepositoryInterface $calendar
     *
     * @return type
     */
    public function __construct(CalendarRepositoryInterface $calendar)
    {
        parent::__construct();
        $this->repository = $calendar;
    }

    /**
     * Show calendar's list.
     *
     * @param string $slug
     *
     * @return response
     */
    protected function index()
    {
        $calendars = $this->repository
            ->pushCriteria(new \Litepie\Calendar\Repositories\Criteria\CalendarPublicCriteria())
            ->scopeQuery(function($query){
                return $query->orderBy('id','DESC');
            })->paginate();

        return $this->theme->of('calendar::public.calendar.index', compact('calendars'))->render();
    }

    /**
     * Show calendar.
     *
     * @param string $slug
     *
     * @return response
     */
    protected function show($slug)
    {
        $calendar = $this->repository->scopeQuery(function($query) use ($slug) {
            return $query->orderBy('id','DESC')
                         ->where('slug', $slug);
        })->first(['*']);

        return $this->theme->of('calendar::public.calendar.show', compact('calendar'))->render();
    }
}
