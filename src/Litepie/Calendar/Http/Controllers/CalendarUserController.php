<?php

namespace Litepie\Calendar\Http\Controllers;

use App\Http\Controllers\UserController as BaseController;
use Form;
use Litepie\Calendar\Http\Requests\CalendarRequest;
use Litepie\Calendar\Interfaces\CalendarRepositoryInterface;
use Litepie\Calendar\Models\Calendar;

class CalendarUserController extends BaseController
{
    /**
     * The authentication guard that should be used.
     *
     * @var string
     */
    protected $guard = 'web';

    /**
     * The home page route of user.
     *
     * @var string
     */
    protected $home = 'home';

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
        $this->repository->pushCriteria(app('Litepie\Repository\Criteria\RequestCriteria'));
        $this->middleware('auth:web');
        $this->middleware('active:web');
        $this->setupTheme(config('theme.themes.user.theme'), config('theme.themes.user.layout'));
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(CalendarRequest $request)
    {
        $guard = $this->getGuardRoute();
        $this->theme->asset()->usepath()->add('fullcalendar-css', 'packages/fullcalendar/fullcalendar.min.css');
        $this->theme->asset()->container('footer')->usepath()->add('fullcalendar-js', 'packages/fullcalendar/fullcalendar.min.js');
        $calendars = $this->repository            
            ->pushCriteria(new \Litepie\Calendar\Repositories\Criteria\CalendarEventCriteria())
            ->scopeQuery(function ($query) {
                return $query->orderBy('id', 'DESC')->where(function($q){              
                        return $q->where(function($qry){
                          return  $qry->whereUserId(user_id('web'))->whereUserType(user_type('web'))->orWhere('assignee_id','=',user_id('web'));
                        });
                }); 
            })->all();
        $this->theme->prependTitle(trans('calendar::calendar.name'));

        return $this->theme->of('calendar::user.calendar.index', compact('calendars','guard'))->render();
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Calendar $calendar
     *
     * @return Response
     */
    public function show(CalendarRequest $request, Calendar $calendar)
    {
        Form::populate($calendar);
        $guard = $this->getGuardRoute();

        return $this->theme->of('calendar::user.calendar.show', compact('calendar','guard'))->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function create(CalendarRequest $request)
    {
        $guard = $this->getGuardRoute();
        $calendar = $this->repository->newInstance([]);
        $calendar['start']=date('Y-m-d H:i',strtotime($request->get('start')));
        $calendar['end']=date('Y-m-d 23:i',strtotime($request->get('end')));        
        Form::populate($calendar);
        return view('calendar::user.calendar.create', compact('calendar','guard'));
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(CalendarRequest $request)
    {
        try {

            $attributes = $request->all();
            $attributes['user_id'] = user_id('web');
            $attributes['user_type'] = user_type('web');
            $calendar = $this->repository->create($attributes);

            return redirect(trans_url($this->getGuardRoute().'/calendar/calendar'))
                ->with('message', trans('messages.success.created', ['Module' => trans('calendar::calendar.name')]))
                ->with('code', 201);

        } catch (Exception $e) {
            redirect()->back()->withInput()->with('message', $e->getMessage())->with('code', 400);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param Calendar $calendar
     *
     * @return Response
     */
    public function edit(CalendarRequest $request, Calendar $calendar)
    {
        $guard = $this->getGuardRoute();
        Form::populate($calendar);

        return view('calendar::user.calendar.edit', compact('calendar','guard'));
    }

    /**
     * Update the specified resource.
     *
     * @param Request $request
     * @param Calendar $calendar
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
            $attributes['user_id'] = user_id('web');
            $attributes['user_type'] = user_type('web');
            $attributes['status'] = 'Calendar';
            if ($status == 'Both') {
                $calendars = $this->repository->newInstance([]);               
                $calendars->create($attributes);
            }
            else
            {
                $calendar->update($attributes);
            }
            return response()->json([
                'message'  => trans('messages.success.updated', ['Module' => trans('calendar::calendar.name')]),
                'code'     => 204,
                'redirect' => trans_url($this->getGuardRoute().'/calendar/calendar/'),
            ], 201);

        } catch (Exception $e) {
            redirect()->back()->withInput()->with('message', $e->getMessage())->with('code', 400);
        }

    }

    /**
     * Remove the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy(CalendarRequest $request, Calendar $calendar)
    {
        try {
            $this->repository->delete($calendar->getRouteKey());
            return response()->json([
                'message'  => trans('messages.success.deleted', ['Module' => trans('calendar::calendar.name')]),
                'code'     => 202,
                
            ], 202);

        } catch (Exception $e) {

            redirect()->back()->withInput()->with('message', $e->getMessage())->with('code', 400);

        }

    }

    /**
     * display the ajaxList.
     *
     * @param int $request
     *
     * @return Response
     */
    public function ajaxList(CalendarRequest $request, $patient_id, $category)
    {

        return $this->repository->getCalendar($patient_id, $category);
    }

    /**
     * display the calendarList.
     *
     * @param int $request
     *
     * @return Response
     */
    public function calendarList(CalendarRequest $request)
    {
        $arr = $this->repository->scopeQuery(function($query){
                       return $query->where('status', '!=', 'Draft')
                        ->where(function ($q){              
                        return $q->where(function($qry){
                          return  $qry->whereUserId(user_id('web'))->orWhere('assignee_id','=',user_id('web'));
                        }); 
                    });
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
        $guard = $this->getGuardRoute();
        $calendars = $this->repository            
            ->pushCriteria(new \Litepie\Calendar\Repositories\Criteria\CalendarEventCriteria())
            ->scopeQuery(function ($query) {
                return $query->orderBy('id', 'DESC')->where(function($q){              
                        return $q->where(function($qry){
                          return  $qry->whereUserId(user_id('web'))->orWhere('assignee_id','=',user_id('web'));
                        });
                }); 
            })->all();

        
        return view('calendar::user.calendar.draft',compact('calendars','guard'));
    }


}
