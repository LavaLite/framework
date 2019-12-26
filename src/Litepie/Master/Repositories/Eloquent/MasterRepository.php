<?php

namespace Litepie\Master\Repositories\Eloquent;

use Litepie\Master\Interfaces\MasterRepositoryInterface;
use Litepie\Repository\Eloquent\BaseRepository;

class MasterRepository extends BaseRepository implements MasterRepositoryInterface
{

    public function boot()
    {
        $this->fieldSearchable = config('master.master.model.search');

    }

    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return config('master.master.model.model');
    }

    /**
     * Return the parent categories.
     *
     * @return string
     */
    public function options($type, $parent = null)
    {
        $options = $this->model
            ->where('type', $type);
        if (!empty($parent)) {
            $options->where('parent_id', $parent);
        }
        $options->orderBy('order', 'DESC');

        return $options->pluck('name', 'id');
    }


    /**
     * Return the category groups.
     *
     * @return string
     */
    public function groups()
    {
        return collect(config('master.masters'))->groupBy('group')->toArray();
    }
    
    /**
     * Return the group count
     *
     * @return array
     */
    public function typeCount()
    {
        return $this->model
            ->select(['type', \DB::raw('count(id) as count')])
            ->groupBy('type')
            ->pluck('count', 'type')
            ->toArray();
    }

}
