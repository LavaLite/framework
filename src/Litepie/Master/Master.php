<?php

namespace Litepie\Master;

use User;

class Master
{
    /**
     * $master object.
     */
    protected $master;

    /**
     * Constructor.
     */
    public function __construct(\Litepie\Master\Interfaces\MasterRepositoryInterface $master)
    {
        $this->master = $master;
    }

    /**
     * Returns count of master.
     *
     * @param array $filter
     *
     * @return int
     */
    public function count()
    {
        return 0;
    }

    /**
     * get options for various fields
     * @return [type] [description]
     */
    public function options($type)
    {

        $options = $this->master->scopeQuery(function ($query) use ($status) {
            return $query->where('type', $type)
                ->where('status', 'show')
                ->orderBy('name', 'ASC');
        })->pluck('name', 'id');

        return $options;

    }
}
