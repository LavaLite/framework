<?php

namespace Litepie\Task\Http\Controller\Api;

use App\Http\Controllers\Controller as BaseController;
use Litepie\Task\Http\Requests\TaskAdminApiRequest;
use Litepie\Task\Interfaces\TaskRepositoryInterface;
use Litepie\Task\Models\Task;

/**
 * Admin API controller class.
 */
class TaskAdminController extends BaseController
{
    /**
     * The authentication guard that should be used.
     *
     * @var string
     */
    protected $guard = 'admin.api';
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
        $this->middleware('api');
        $this->middleware('jwt.auth:admin.api');
        $this->setupTheme(config('theme.themes.admin.theme'), config('theme.themes.admin.layout'));
        parent::__construct();
    }

    /**
     * Display a list of task.
     *
     * @return json
     */
    public function index(TaskAdminApiRequest $request)
    {
        $tasks  = $this->repository
            ->setPresenter('\\Litepie\\Task\\Repositories\\Presenter\\TaskListPresenter')
            ->scopeQuery(function($query){
                return $query->orderBy('id','DESC');
            })->all();
        $tasks['code'] = 2000;
        return response()->json($tasks) 
                         ->setStatusCode(200, 'INDEX_SUCCESS');

    }

    /**
     * Display task.
     *
     * @param Request $request
     * @param Model   Task
     *
     * @return Json
     */
    public function show(TaskAdminApiRequest $request, Task $task)
    {
        $task         = $task->presenter();
        $task['code'] = 2001;
        return response()->json($task)
                         ->setStatusCode(200, 'SHOW_SUCCESS');;

    }

    /**
     * Show the form for creating a new task.
     *
     * @param Request $request
     *
     * @return json
     */
    public function create(TaskAdminApiRequest $request, Task $task)
    {
        $task         = $task->presenter();
        $task['code'] = 2002;
        return response()->json($task)
                         ->setStatusCode(200, 'CREATE_SUCCESS');

    }

    /**
     * Create new task.
     *
     * @param Request $request
     *
     * @return json
     */
    public function store(TaskAdminApiRequest $request)
    {
        try {
            $attributes             = $request->all();
            $attributes['user_id']  = user_id('admin.api');
            $attributes['user_type'] = user_type();
            $task          = $this->repository->create($attributes);
            $task          = $task->presenter();
            $task['code']  = 2004;

            return response()->json($task)
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
     * Show task for editing.
     *
     * @param Request $request
     * @param Model   $task
     *
     * @return json
     */
    public function edit(TaskAdminApiRequest $request, Task $task)
    {
        $task         = $task->presenter();
        $task['code'] = 2003;
        return response()-> json($task)
                        ->setStatusCode(200, 'EDIT_SUCCESS');;
    }

    /**
     * Update the task.
     *
     * @param Request $request
     * @param Model   $task
     *
     * @return json
     */
    public function update(TaskAdminApiRequest $request, Task $task)
    {
        try {

            $attributes = $request->all();

            $task->update($attributes);
            $task         = $task->presenter();
            $task['code'] = 2005;

            return response()->json($task)
                             ->setStatusCode(201, 'UPDATE_SUCCESS');


        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 4005,
            ])->setStatusCode(400, 'UPDATE_ERROR');

        }
    }

    /**
     * Remove the task.
     *
     * @param Request $request
     * @param Model   $task
     *
     * @return json
     */
    public function destroy(TaskAdminApiRequest $request, Task $task)
    {

        try {

            $t = $task->delete();

            return response()->json([
                'message'  => trans('messages.success.delete', ['Module' => trans('task::task.name')]),
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
