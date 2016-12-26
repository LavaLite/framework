<?php

namespace Litepie\Calendar\Http\Controllers;

use App\Http\Controllers\AdminController as BaseController;
use Form;
use Litepie\Calendar\Http\Requests\CalendarRequest;
use Litepie\Calendar\Interfaces\CalendarRepositoryInterface;
use Litepie\Calendar\Models\Calendar;

/**
 * Admin web controller class.
 */
class CalendarAdminController extends BaseController
{

    /**
     * The authentication guard that should be used.
     *
     * @var string
     */
    public $guard = 'admin.web';

    /**
     * The home page route of admin.
     *
     * @var string
     */
    public $home = 'admin';

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
        $this->middleware('web');
        $this->middleware('auth:admin.web');
        $this->setupTheme(config('theme.themes.admin.theme'), config('theme.themes.admin.layout'));
        parent::__construct();
    }

    /**
     * Display a list of calendar.
     *
     * @return Response
     */
    public function index(CalendarRequest $request)
    {
        $this->theme->asset()->usepath()->add('fullcalendar-css', 'packages/fullcalendar/fullcalendar.min.css');
        $this->theme->asset()->container('extra')->usepath()->add('jquery-ui', 'packages/jquery-ui/jquery-ui.js');
        $this->theme->asset()->container('extra')->usepath()->add('fullcalendar-js', 'packages/fullcalendar/fullcalendar.min.js');

       
        $calendars = $this->repository
            ->pushCriteria(new \Litepie\Calendar\Repositories\Criteria\CalendarAdminCriteria())
            ->pushCriteria(new \Litepie\Calendar\Repositories\Criteria\CalendarEventCriteria())       
            ->scopeQuery(function ($query) {
                return $query->orderBy('id', 'DESC');
            })->all();

        $this->theme->prependTitle(trans('calendar::calendar.names') . ' :: ');
        return $this->theme->of('calendar::admin.calendar.index',compact('calendars'))->render();
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

        if (!$calendar->exists) {
            return response()->view('calendar::admin.calendar.new', compact('calendar'));
        }

        Form::populate($calendar);
        return response()->view('calendar::admin.calendar.show', compact('calendar'));
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
 
        $calendar = $this->repository->newInstance([]);
       @$calendar['start']=date('Y-m-d H:i',strtotime($request->get('dates')));
       @$calendar['end']=date('Y-m-d 23:i',strtotime($request->get('dates')));
   
        Form::populate($calendar);

        return response()->view('calendar::admin.calendar.create', compact('calendar'));

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
            $attributes = $request->all();          
            $attributes['user_id'] = user_id('admin.web');
            $attributes['user_type'] = user_type();
            $calendar = $this->repository->create($attributes);

            return redirect(trans_url('/admin/calendar/calendar'))
                ->with('message', trans('messages.success.created', ['Module' => trans('calendar::calendar.name')]))
                ->with('code', 201);

        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'code'    => 400,
            ], 400);
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
            if($request->has('data')){
                parse_str($request->get('data'), $attributes);
            }
            else{
                $attributes=$request->all();
            }
            $status = $attributes['status'];
            

            if ($status == 'Both') {
                $attributes['user_id'] = user_id("admin.web");
                $attributes['user_type'] = user_type("admin.web");
                $calendar->create($attributes);
            } else {
                $calendar->update($attributes);
            }            

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

         $arr = $this->repository->scopeQuery(function($query){
                       return $query->where('status', '!=', 'Draft');
                       
                 })->all();

        $temp = [];
        foreach ($arr as $key => $value) {

            $temp[$key]['id'] = $value->getRouteKey();
            $temp[$key]['title'] = $value['title'];
            $temp[$key]['start'] = date('Y-m-d H:i:s', strtotime($value['start']));
            $temp[$key]['end'] = date('Y-m-d H:i:s', strtotime($value['end']));
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

        
        return view('calendar::admin.calendar.draft',compact('calendars'));
    }


}
