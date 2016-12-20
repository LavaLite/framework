<?php

namespace Litepie\Task;

class Task
{
    /**
     * $task object.
     */
    protected $task;

    /**
     * Constructor.
     */
    public function __construct(\Litepie\Task\Interfaces\TaskRepositoryInterface $task)
    {
        $this->task = $task;
    }

    /**
     * Display tasks of the user.
     *
     * @return Response
     */
    public function display($view)
    {
        return view('task::admin.task.' . $view);
    }

    /**
     * Returns count of tasks.
     *
     * @param array $filter
     *
     * @return int
     */
    public function count($type='admin.web')
    {
        return $this->task->scopeQuery(function($query)use($type){
                return $query->whereUserId(user_id($type))
                            ->whereUserType(user_type($type));
            })->count();
    }

    public function completed()
    {
        return $this->task->completed();
    }

    public function todo()
    {
        return $this->task->todo();
    }

    public function tasks()
    {
        return $this->task->scopeQuery(function($query){
                return $query->orderBy('id','DESC');
            })->all();
    }

     /**
     * Returns gadgets.
     *
     * @param array $filter
     *
     * @return int
     */
    public function gadget($view = 'admin.task.gadget', $count = 10)
    {
        $tasks = $this->task->scopeQuery(function($query)use($count){
                return $query->take($count);
            })->all();

        return view('task::' . $view, compact('tasks'))->render();
    }
    /**
     * Returns gadgets.
     *
     * @param array $filter
     *
     * @return int
     */
    public function userGadget($count = 20,$view = 'user.task.gadget')
    {
        $tasks = $this->task->scopeQuery(function($query)use($count){
                return $query->where('status','<>','completed')->where(function($q){
                    return $q->whereUserId(user_id('web'))->orWhere('assigned_to','=',user_id('web'));
                })->orderBy('id','Desc')->take($count);
            })->all();

        return view('task::' . $view, compact('tasks'));
    }



    public function users()
    {
        $list = \User::all();
        $users = [];
        foreach ($list as $key => $value) {
            $users[$value['id']] = $value['name'];
        }
        return $users;
    }

    public function getData($id)
    {
        return $this->task->find($id);
    }
}
