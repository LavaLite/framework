<?php

namespace Litepie\Calendar\Http\Controllers\Api;

use App\Http\Controllers\Controller as BaseController;
use Litepie\Calendar\Interfaces\CalendarRepositoryInterface;
use Litepie\Calendar\Repositories\Presenter\CalendarItemTransformer;

/**
 * Pubic API controller class.
 */
class CalendarController extends BaseController
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
        $this->repository = $calendar;
        $this->middleware('api');
        parent::__construct();
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
            ->setPresenter('\\Litepie\\Calendar\\Repositories\\Presenter\\CalendarListPresenter')
            ->scopeQuery(function($query){
                return $query->orderBy('id','DESC');
            })->paginate();

        $calendars['code'] = 2000;
        return response()->json($calendars)
                ->setStatusCode(200, 'INDEX_SUCCESS');
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
        $calendar = $this->repository
            ->scopeQuery(function($query) use ($slug) {
            return $query->orderBy('id','DESC')
                         ->where('slug', $slug);
        })->first(['*']);

        if (!is_null($calendar)) {
            $calendar         = $this->itemPresenter($module, new CalendarItemTransformer);
            $calendar['code'] = 2001;
            return response()->json($calendar)
                ->setStatusCode(200, 'SHOW_SUCCESS');
        } else {
            return response()->json([])
                ->setStatusCode(400, 'SHOW_ERROR');
        }

    }
}
