<?php

namespace Litepie\Task\Repositories\Eloquent;

use Litepie\Task\Interfaces\TaskRepositoryInterface;
use Litepie\Repository\Eloquent\BaseRepository;

class TaskRepository extends BaseRepository implements TaskRepositoryInterface
{
    /**
     * Booting the repository.
     *
     * @return null
     */
    public function boot()
    {
       
        
    }

    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        $this->fieldSearchable = config('litepie.task.task.search');
        return config('litepie.task.task.model');
    }


    
}
