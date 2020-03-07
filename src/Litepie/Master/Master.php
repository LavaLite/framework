<?php

namespace Litepie\Master;

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
     * Returns count of master types.
     *
     * @param array $filter
     *
     * @return int
     */
    public function typeCount()
    {
        return $this->master->typeCount();
    }

    /**
     * get options for various fields
     * @return [type] [description]
     */
    public function options($type, $key='id', $value = 'name', $id = 0)
    {
        return $this->master->options($type, $key, $value, $id);
    }

    /**
     * Get options as json
     * @return [json] [description]
     */
    public function toJson($type, $key='id', $value = 'name', $id = 0)
    {
        return $this->master->search('', $type, $key, $value, $id);
    }
}
