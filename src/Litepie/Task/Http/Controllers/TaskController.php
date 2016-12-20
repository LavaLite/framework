<?php

namespace Litepie\Task\Http\Controllers;

use App\Http\Controllers\Controller as BaseController;
use Litepie\Task\Interfaces\TaskRepositoryInterface;

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
        $this->middleware('web');
        $this->setupTheme(config('theme.themes.public.theme'), config('theme.themes.public.layout'));
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
        $tasks = $this->repository->scopeQuery(function($query){
            return $query->orderBy('id','DESC');
        })->paginate();

        return $this->theme->of('task::public.task.index', compact('tasks'))->render();
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
        $task = $this->repository->scopeQuery(function($query) use ($slug) {
            return $query->orderBy('id','DESC')
                         ->where('slug', $slug);
        })->first(['*']);

        return $this->theme->of('task::public.task.show', compact('task'))->render();
    }
}
