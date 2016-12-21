<?php

namespace Litepie\Task\Http\Controllers;

use App\Http\Controllers\AdminController as BaseController;
use Form;
use Litepie\Task\Http\Requests\TaskRequest;
use Litepie\Task\Interfaces\TaskRepositoryInterface;
use Litepie\Task\Models\Task;

/**
 * Admin web controller class.
 */
class TaskAdminController extends BaseController
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
        $this->middleware('web');
        $this->middleware('auth:admin.web');
        $this->setupTheme(config('theme.themes.admin.theme'), config('theme.themes.admin.layout'));
        parent::__construct();
    }

    /**
     * Display a list of task.
     *
     * @return Response
     */
    public function index(TaskRequest $request)
    {
        $tasks  = $this->repository
                ->setPresenter('\\Litepie\\Task\\Repositories\\Presenter\\TaskListPresenter')
                ->scopeQuery(function ($query) {
                    return $query->orderBy('id', 'DESC');
                })->all();

        $this->theme->prependTitle(trans('task::task.names').' :: ');
        return $this->theme->of('task::admin.task.index', compact('tasks'))->render();
    }
    


    /**
     * Display task.
     *
     * @param Request $request
     * @param Model   $task
     *
     * @return Response
     */
    public function show(TaskRequest $request, Task $task)
    {
        if (!$task->exists) {
            return response()->view('task::admin.task.new', compact('task'));
        }
        
        Form::populate($task);
        return response()->view('task::admin.task.show', compact('task'));
    }

    /**
     * Show the form for creating a new task.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function create(TaskRequest $request)
    {

        $task = $this->repository->newInstance([]);

        Form::populate($task);

        return response()->view('task::admin.task.create', compact('task'));

    }

    /**
     * Create new task.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(TaskRequest $request)
    {
        try {
            $attributes             = $request->all();
            $attributes['status']  = $attributes['new-status'];
            $attributes['task']  = $attributes['new-task'];
            $attributes['user_type'] = user_type();
            $attributes['user_id']  = user_id('admin.web');
            $attributes['user_type'] = user_type();
            $task          = $this->repository->create($attributes);

            return response()->json([
                'message'  => trans('messages.success.updated', ['Module' => trans('task::task.name')]),
                'code'     => 204,
                'redirect' => trans_url('/admin/task/status?search[status]='.$task['status'])
            ], 201);


        } catch (Exception $e) {
            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 400,
            ], 400);
        }
    }

    /**
     * Show task for editing.
     *
     * @param Request $request
     * @param Model   $task
     *
     * @return Response
     */
    public function edit(TaskRequest $request, Task $task)
    {
        Form::populate($task);
        return  response()->view('task::admin.task.edit', compact('task'));
    }

    /**
     * Update the task.
     *
     * @param Request $request
     * @param Model   $task
     *
     * @return Response
     */
    public function update(TaskRequest $request, Task $task)
    {
        try {

            $attributes = $request->all();
            $task->update($attributes);

            return response()->json([
                'message'  => trans('messages.success.updated', ['Module' => trans('task::task.name')]),
                'code'     => 204,   
                'redirect' => trans_url('/admin/task/status?search[status]='.$task['status']),             
            ], 201);

        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 400,
                'redirect' => trans_url('/admin/task/task/'.$task->getRouteKey()),
            ], 400);

        }
    }

    /**
     * Remove the task.
     *
     * @param Model   $task
     *
     * @return Response
     */
    public function destroy(TaskRequest $request, Task $task)
    {

        try {

            $t = $task->delete();

            return response()->json([
                'message'  => trans('messages.success.deleted', ['Module' => trans('task::task.name')]),
                'code'     => 202,
                'redirect' => trans_url('/admin/task/status?search[status]='.$task['status']),
            ], 202);

        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 400,
                'redirect' => trans_url('/admin/task/task/'.$task->getRouteKey()),
            ], 400);
        }
    }
    
    public function taskList(TaskRequest $request)
    {
        $status=$request->get('search');
        $status=$status['status'];
        $tasks  = $this->repository
                    ->scopeQuery(function($query){
                            return  $query->orderBy('id','DESC');            
                    })->all();       
          return view('task::admin.task.task_list', compact('tasks','status'));
    }
}
