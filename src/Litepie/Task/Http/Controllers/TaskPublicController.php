<?php

namespace Litepie\Task\Http\Controllers;

use App\Http\Controllers\PublicController as BaseController;
use Litepie\Task\Interfaces\TaskRepositoryInterface;

class TaskPublicController extends BaseController
{
    /**
     * Constructor.
     *
     * @param type \Litepie\Task\Interfaces\TaskRepositoryInterface $task
     *
     * @return type
     */
    public function __construct(
        TaskRepositoryInterface $task
    ) {
        $this->repository = $task;
        $this->setupTheme();
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
        $tasks = $this->repository->scopeQuery(function ($query) {
            return $query->orderBy('id', 'DESC');
        })->paginate();
->view($this->getView('task::public.task.index')->data(compact('tasks'))->output();
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
        $task = $this->repository->scopeQuery(function ($query) use ($slug) {
            return $query->orderBy('id', 'DESC')
                ->where('slug', $slug);
        })->first(['*']);
->view($this->getView('task::public.task.show', compact('task'))->output();
    }
}
