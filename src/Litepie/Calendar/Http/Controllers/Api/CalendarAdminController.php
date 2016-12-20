<?php

namespace Litepie\Calendar\Http\Controllers\Api;

use App\Http\Controllers\Controller as BaseController;
use Litepie\Calendar\Http\Requests\CalendarRequest;
use Litepie\Calendar\Interfaces\CalendarRepositoryInterface;
use Litepie\Calendar\Models\Calendar;

/**
 * Admin API controller class.
 */
class CalendarAdminController extends BaseController
{
    /**
     * The authentication guard that should be used.
     *
     * @var string
     */
        protected $guard = 'admin.api';
    
    /**
     * Initialize calendar controller.
     *
     * @param type CalendarRepositoryInterface $calendar
     *
     * @return type
     */
    public function __construct(CalendarRepositoryInterface $calendar)
    {
        $this->repository = $calendar;
        $this->middleware('api');
        $this->middleware('jwt.auth:admin.api');
        $this->setupTheme(config('theme.themes.admin.theme'), config('theme.themes.admin.layout'));
        parent::__construct();
    }

    /**
     * Display a list of calendar.
     *
     * @return json
     */
    public function index(CalendarRequest $request)
    {
        $calendars  = $this->repository
            ->pushCriteria(new \Litepie\Calendar\Repositories\Criteria\CalendarAdminCriteria())
            ->setPresenter('\\Litepie\\Calendar\\Repositories\\Presenter\\CalendarListPresenter')
            ->scopeQuery(function($query){
                return $query->orderBy('id','DESC');
            })->all();
        $calendars['code'] = 2000;
        return response()->json($calendars) 
                         ->setStatusCode(200, 'INDEX_SUCCESS');

    }

    /**
     * Display calendar.
     *
     * @param Request $request
     * @param Model   Calendar
     *
     * @return Json
     */
    public function show(CalendarRequest $request, Calendar $calendar)
    {
        $calendar         = $calendar->presenter();
        $calendar['code'] = 2001;
        return response()->json($calendar)
                         ->setStatusCode(200, 'SHOW_SUCCESS');;

    }

    /**
     * Show the form for creating a new calendar.
     *
     * @param Request $request
     *
     * @return json
     */
    public function create(CalendarRequest $request, Calendar $calendar)
    {
        $calendar         = $calendar->presenter();
        $calendar['code'] = 2002;
        return response()->json($calendar)
                         ->setStatusCode(200, 'CREATE_SUCCESS');

    }

    /**
     * Create new calendar.
     *
     * @param Request $request
     *
     * @return json
     */
    public function store(CalendarRequest $request)
    {
        try {
            $attributes             = $request->all();
            $attributes['user_id']  = user_id('admin.api');
            $attributes['user_type'] = user_type();
            $calendar          = $this->repository->create($attributes);
            $calendar          = $calendar->presenter();
            $calendar['code']  = 2004;

            return response()->json($calendar)
                             ->setStatusCode(201, 'STORE_SUCCESS');
        } catch (Exception $e) {
            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 4004,
            ])->setStatusCode(400, 'STORE_ERROR');
;
        }
    }

    /**
     * Show calendar for editing.
     *
     * @param Request $request
     * @param Model   $calendar
     *
     * @return json
     */
    public function edit(CalendarRequest $request, Calendar $calendar)
    {
        $calendar         = $calendar->presenter();
        $calendar['code'] = 2003;
        return response()-> json($calendar)
                        ->setStatusCode(200, 'EDIT_SUCCESS');;
    }

    /**
     * Update the calendar.
     *
     * @param Request $request
     * @param Model   $calendar
     *
     * @return json
     */
    public function update(CalendarRequest $request, Calendar $calendar)
    {
        try {

            $attributes = $request->all();

            $calendar->update($attributes);
            $calendar         = $calendar->presenter();
            $calendar['code'] = 2005;

            return response()->json($calendar)
                             ->setStatusCode(201, 'UPDATE_SUCCESS');


        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 4005,
            ])->setStatusCode(400, 'UPDATE_ERROR');

        }
    }

    /**
     * Remove the calendar.
     *
     * @param Request $request
     * @param Model   $calendar
     *
     * @return json
     */
    public function destroy(CalendarRequest $request, Calendar $calendar)
    {

        try {

            $t = $calendar->delete();

            return response()->json([
                'message'  => trans('messages.success.delete', ['Module' => trans('calendar::calendar.name')]),
                'code'     => 2006
            ])->setStatusCode(202, 'DESTROY_SUCCESS');

        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 4006,
            ])->setStatusCode(400, 'DESTROY_ERROR');
        }
    }
}
