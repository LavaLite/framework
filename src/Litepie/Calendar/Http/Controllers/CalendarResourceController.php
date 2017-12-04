<?php

namespace Litepie\Calendar\Http\Controllers;

use App\Http\Controllers\ResourceController as BaseController;
use Form;
use Litepie\Calendar\Http\Requests\CalendarRequest;
use Litepie\Calendar\Interfaces\CalendarRepositoryInterface;
use Litepie\Calendar\Models\Calendar;

/**
 * Admin web controller class.
 */
class CalendarResourceController extends BaseController
{

    /**
     * Initialize calendar controller.
     *
     * @param type CalendarRepositoryInterface $calendar
     *
     * @return type
     */
    public function __construct(CalendarRepositoryInterface $calendar)
    {
        parent::__construct();
        $this->repository = $calendar;
        $this->repository
            ->pushCriteria(\Litepie\Repository\Criteria\RequestCriteria::class)
            ->pushCriteria(\Litepie\Calendar\Repositories\Criteria\CalendarResourceCriteria::class);
    }

    /**
     * Display a list of calendar.
     *
     * @return Response
     */
    public function index(CalendarRequest $request)
    {

        $calendars = $this->repository
            ->all();

        return $this->response
            ->title(trans('calendar::calendar.names'))
            ->view('calendar::calendar.index', true)
            ->data(compact('calendars'))
            ->output();

    }

    /**
     * Display calendar.
     *
     * @param Request $request
     * @param Model   $calendar
     *
     * @return Response
     */
    public function show(CalendarRequest $request, Calendar $calendar)
    {

        if ($calendar->exists) {
            $view = 'calendar::calendar.show';
        } else {
            $view = 'calendar::calendar.new';
        }

        return $this->response
            ->title(trans('app.view') . ' ' . trans('calendar::calendar.name'))
            ->data(compact('calendar'))
            ->view($view, true)
            ->output();
    }

    /**
     * Show the form for creating a new calendar.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function create(CalendarRequest $request)
    {

        $calendar          = $this->repository->newInstance([]);
        $calendar['start'] = format_date_time(request('start'));
        $calendar['end']   = format_date_time(request('end'));

        Form::populate($calendar);

        return $this->response
            ->title(trans('app.create') . ' ' . trans('calendar::calendar.name'))
            ->data(compact('calendar'))
            ->view('calendar::calendar.create', true)
            ->output();

    }

    /**
     * Create new calendar.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(CalendarRequest $request)
    {
        try {
            $attributes              = $request->all();
            $attributes['user_id']   = user_id();
            $attributes['user_type'] = user_type();
            $calendar                = $this->repository->create($attributes);
            return $this->response->message(trans('messages.success.created', ['Module' => trans('calendar::calendar.name')]))
                ->code(204)
                ->status('success')
                ->url(trans_url($this->getGuardRoute() . '/calendar/calendar/' . $calendar->getRouteKey()))
                ->redirect();
        } catch (Exception $e) {
            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(trans_url($this->getGuardRoute() . '/calendar/calendar'))
                ->redirect();
        }

    }

    /**
     * Show calendar for editing.
     *
     * @param Request $request
     * @param Model   $calendar
     *
     * @return Response
     */
    public function edit(CalendarRequest $request, Calendar $calendar)
    {
        Form::populate($calendar);
        return response()->view('calendar::admin.calendar.edit', compact('calendar'));
    }

    /**
     * Update the calendar.
     *
     * @param Request $request
     * @param Model   $calendar
     *
     * @return Response
     */
    public function update(CalendarRequest $request, Calendar $calendar)
    {
        try {

            $attributes = $request->all();

            $calendar->update($attributes);
            return response()->json([
                'message'  => trans('messages.success.updated', ['Module' => trans('calendar::calendar.name')]),
                'code'     => 204,
                'redirect' => trans_url('/admin/calendar/calendar/'),
            ], 201);

        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 400,
                'redirect' => trans_url('/admin/calendar/calendar/'),
            ], 400);

        }

    }

    /**
     * Remove the calendar.
     *
     * @param Model   $calendar
     *
     * @return Response
     */
    public function destroy(CalendarRequest $request, Calendar $calendar)
    {

        try {

            $t = $calendar->delete();

            return response()->json([
                'message'  => trans('messages.success.deleted', ['Module' => trans('calendar::calendar.name')]),
                'code'     => 202,
                'redirect' => trans_url('/admin/calendar/calendar/0'),
            ], 202);

        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 400,
                'redirect' => trans_url('/admin/calendar/calendar/' . $calendar->getRouteKey()),
            ], 400);
        }

    }

    /**
     * display the calendarList.
     *
     * @return Response
     */
    public function calendarList()
    {

        $arr = $this->repository->scopeQuery(function ($query) {
            return $query->where('status', '!=', 'Draft');

        })->all();

        $temp = [];

        foreach ($arr as $key => $value) {

            $temp[$key]['id']        = $value->getRouteKey();
            $temp[$key]['title']     = $value['title'];
            $temp[$key]['start']     = date('Y-m-d H:i:s', strtotime($value['start']));
            $temp[$key]['end']       = date('Y-m-d H:i:s', strtotime($value['end']));
            $temp[$key]['className'] = $value['color'];
        }

        return json_encode($temp);
    }

    /**
     * Display a list of calendar.
     *
     * @return Response
     */
    public function draft(CalendarRequest $request)
    {

        $calendars = $this->repository
            ->pushCriteria(new \Litepie\Calendar\Repositories\Criteria\CalendarAdminCriteria())
            ->pushCriteria(new \Litepie\Calendar\Repositories\Criteria\CalendarEventCriteria())
            ->scopeQuery(function ($query) {
                return $query->orderBy('id', 'DESC');
            })->all();

        return view('calendar::admin.calendar.draft', compact('calendars'));
    }

}
