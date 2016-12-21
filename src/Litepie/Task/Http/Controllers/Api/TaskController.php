<?php

namespace Litepie\Task\Http\Controllers\Api;

use App\Http\Controllers\Controller as BaseController;
use Litepie\Task\Interfaces\TaskRepositoryInterface;
use Litepie\Task\Repositories\Presenter\TaskItemTransformer;

/**
 * Pubic API controller class.
 */
class TaskController extends BaseController
{
    /**
     * Constructor.
     *
     * @param type \Litepie\Task\Interfaces\TaskRepositoryInterface $task
     *
     * @return type
     */
    public function __construct(TaskRepositoryInterface $task)
    {
        $this->repository = $task;
        $this->middleware('api');
        parent::__construct();
    }

    /**
     * Show task's list.
     *
     * @param string $slug
     *
     * @return response
     */
    protected function index()
    {
        $tasks = $this->repository
            ->setPresenter('\\Litepie\\Task\\Repositories\\Presenter\\TaskListPresenter')
            ->scopeQuery(function($query){
                return $query->orderBy('id','DESC');
            })->paginate();

        $tasks['code'] = 2000;
        return response()->json($tasks)
                ->setStatusCode(200, 'INDEX_SUCCESS');
    }

    /**
     * Show task.
     *
     * @param string $slug
     *
     * @return response
     */
    protected function show($slug)
    {
        $task = $this->repository
            ->scopeQuery(function($query) use ($slug) {
            return $query->orderBy('id','DESC')
                         ->where('slug', $slug);
        })->first(['*']);

        if (!is_null($task)) {
            $task         = $this->itemPresenter($module, new TaskItemTransformer);
            $task['code'] = 2001;
            return response()->json($task)
                ->setStatusCode(200, 'SHOW_SUCCESS');
        } else {
            return response()->json([])
                ->setStatusCode(400, 'SHOW_ERROR');
        }

    }
}
