<?php
namespace Litepie\Task\Http\Controllers;

use App\Http\Controllers\ResourceController as BaseController;
use Litepie\Task\Http\Requests\TaskRequest;
use Litepie\Task\Interfaces\TaskRepositoryInterface;
use Litepie\Task\Models\Task;

/**
 * Resource controller class for task.
 */
class TaskResourceController extends BaseController
{

    /**
     * Initialize task resource controller.
     *
     * @param type TaskRepositoryInterface $task
     *
     * @return null
     */
    public function __construct(TaskRepositoryInterface $task)
    {
        parent::__construct();
        $this->repository = $task;
        $this->repository
            ->pushCriteria(\Litepie\Repository\Criteria\RequestCriteria::class)
            ->pushCriteria(\Litepie\Task\Repositories\Criteria\TaskResourceCriteria::class);
    }

    /**
     * Display a list of task.
     *
     * @return Response
     */
    public function index(TaskRequest $request)
    {

        if ($this->response->typeIs('json')) {
            $pageLimit = $request->input('pageLimit');
            $data      = $this->repository
                ->setPresenter(\Litepie\Task\Repositories\Presenter\TaskListPresenter::class)
                ->getDataTable($pageLimit);
            return $this->response
                ->data($data)
                ->output();
        }

        $tasks = $this->repository->paginate();

        return $this->response->title(trans('task::task.names'))
            ->view('task::task.index', true)
            ->data(compact('tasks'))
            ->output();
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

        if ($task->exists) {
            $view = 'task::task.show';
        } else {
            $view = 'task::task.new';
        }

        return $this->response->title(trans('app.view') . ' ' . trans('task::task.name'))
            ->data(compact('task'))
            ->view($view, true)
            ->output();
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
        return $this->response->title(trans('app.new') . ' ' . trans('task::task.name')) 
            ->view('task::task.create', true) 
            ->data(compact('task'))
            ->output();
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
            $attributes              = $request->all();
            $attributes['user_id']   = user_id();
            $attributes['user_type'] = user_type();
            $task                 = $this->repository->create($attributes);

            return $this->response->message(trans('messages.success.created', ['Module' => trans('task::task.name')]))
                ->code(204)
                ->status('success')
                ->url(guard_url('task/task/status?search[status]=to_do'))
                ->redirect();
        } catch (Exception $e) {
            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('/task/task/status?search[status]=to_do'))
                ->redirect();
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
        return $this->response->title(trans('app.edit') . ' ' . trans('task::task.name'))
            ->view('task::task.edit', true)
            ->data(compact('task'))
            ->output();
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
            return $this->response->message(trans('messages.success.updated', ['Module' => trans('task::task.name')]))
                ->code(204)
                ->status('success')
                ->url(guard_url('task/task/status?search[status]=' . $task->status))
                ->redirect();
        } catch (Exception $e) {
            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('task/task/status?search[status]=' . $task->status))
                ->redirect();
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

            $task->delete();
            return $this->response->message(trans('messages.success.deleted', ['Module' => trans('task::task.name')]))
                ->code(202)
                ->status('success')
                ->url(guard_url('task/task'))
                ->redirect();

        } catch (Exception $e) {

            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('task/task/' . $task->getRouteKey()))
                ->redirect();
        }

    }

    public function taskList(TaskRequest $request)
    {
        $status = $request->get('search');
        $status = $status['status'];
        $tasks  = $this->repository
            ->scopeQuery(function ($query) {
                return $query->orderBy('id', 'DESC');
            })->all();
        return $this->response->title(trans('app.new') . ' ' . trans('task::task.name')) 
            ->view('task::task.task_list', true) 
            ->data(compact('tasks', 'status'))
            ->output();
    }

}
