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
    public function options($type, $id = 0)
    {
        return $this->model
            ->where('parent_id', 0)
            ->where('type', $type)
            ->pluck('name', 'id');
    }

    /**
     * Return the parent categories.
     *
     * @return string
     */
    public function typeCount()
    {
        return $this->model
            ->select(['type', \DB::raw('count(id) as count')])
            ->groupBy('type')
            ->pluck('count', 'type')
            ->toArray();
    }

    /**
     * Return the parent categories.
     *
     * @return string
     */
    public function groups()
    {
        return collect(config('master.masters'))->groupBy('group')->toArray();
    }

    public function getOptions($type)
    {
        return $this->model->where('type', $type)
            ->where('status', 'Show')
            ->pluck('name', 'id');
    }

    public function search($string, $type, $key, $value) {
		return $this->model->where('type', 'like', '%' . $type . '%')
			->where('status', 'Show')
			->where('name', 'like', '%' . $string . '%')
			->select("$value as name", "$key as key")->take(50)->get();
	}

}
