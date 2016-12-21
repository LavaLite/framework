<?php

namespace Litepie\Task\Http\Controllers;

use App\Http\Controllers\UserController as BaseController;
use Form;
use Litepie\Task\Http\Requests\TaskRequest;
use Litepie\Task\Interfaces\TaskRepositoryInterface;
use Litepie\Task\Models\Task;

class TaskUserController extends BaseController
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
     * Initialize task controller.
     *
     * @param type TaskRepositoryInterface $task
     *
     * @return type
     */
    public function __construct(TaskRepositoryInterface $task)
    {
        $this->repository = $task;
        $this->repository->pushCriteria(app('Litepie\Repository\Criteria\RequestCriteria'));
        $this->middleware('auth:web');
        $this->middleware('active:web');
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(TaskRequest $request)
    {
        
        $guard = $this->getGuardRoute();

        $tasks  = $this->repository
                ->pushCriteria(new \Litepie\Task\Repositories\Criteria\TaskUserCriteria())
                ->setPresenter('\\Litepie\\Task\\Repositories\\Presenter\\TaskListPresenter')
                ->scopeQuery(function ($query) {
                    return $query->orderBy('id', 'DESC');
                })->all();

        $this->theme->prependTitle(trans('task::task.names'));

        return $this->theme->of('task::user.task.index', compact('tasks','guard'))->render();
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Task $task
     *
     * @return Response
     */
    public function show(TaskRequest $request, Task $task)
    {
        Form::populate($task);
        $guard = $this->getGuardRoute();

        return $this->theme->of('task::user.task.show', compact('task','guard'))->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function create(TaskRequest $request)
    {
        $guard = $this->getGuardRoute();
        $task = $this->repository->newInstance([]);
        Form::populate($task);

        return $this->theme->of('task::user.task.create', compact('task','guard'))->render();
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(TaskRequest $request)
    {
        try {
            $attributes = $request->all();     
            $attributes['user_id'] = user_id('web');
            $attributes['assigned_to'] = user_id('web');
            $attributes['user_type'] = user_type('web');
            $task = $this->repository->create($attributes);

            return response()->json([
                'message'  => trans('messages.success.created', ['Module' => trans('task::task.name')]),
                'code'     => 204,
                'redirect' => trans_url($this->getGuardRoute().'/task/status?search[status]='.$task['status'])
            ], 201);

        } catch (Exception $e) {
            redirect()->back()->withInput()->with('message', $e->getMessage())->with('code', 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param Task $task
     *
     * @return Response
     */
    public function edit(TaskRequest $request, Task $task)
    {
        $guard = $this->getGuardRoute();
        Form::populate($task);

        return  response()->view('task::user.task.edit', compact('task','guard'));
    }

    /**
     * Update the specified resource.
     *
     * @param Request $request
     * @param Task $task
     *
     * @return Response
     */
    public function update(TaskRequest $request, Task $task)
    {
        try {
            $this->repository->update($request->all(), $task->getRouteKey());

            return response()->json([
                'message'  => trans('messages.success.updated', ['Module' => trans('task::task.name')]),
                'code'     => 204,
                'redirect' => trans_url($this->getGuardRoute().'/task/status?search[status]='.$task['status'])
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
    public function destroy(TaskRequest $request, Task $task)
    {
        try {
            $this->repository->delete($task->getRouteKey());
            return response()->json([
                'message'  => trans('messages.success.deleted', ['Module' => trans('task::task.name')]),
                'code'     => 202,
                'redirect' => trans_url($this->getGuardRoute().'/task/status?search[status]='.$task['status']),
            ], 202);


        } catch (Exception $e) {

            redirect()->back()->withInput()->with('message', $e->getMessage())->with('code', 400);

        }
    }

    public function taskList(TaskRequest $request)
    {
        $guard = $this->getGuardRoute();
        $status=$request->get('search');
        $status=$status['status'];
        $tasks  = $this->repository
                    ->scopeQuery(function($query){
                            return  $query->where(function($q){
                                    $q->whereAssignedTo(user_id('web'))
                                    ->orWhere('user_id','=',user_id('web'));
                            })->orderBy('id','DESC');            
                    })->all(); 

        return view('task::user.task.task_list', compact('tasks','status','guard'));
    }
}
