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
     * get options for various fields
     * @return [type] [description]
     */
    public function options($type)
    {
        $options = $this->master->options($type);
        return $options;
    }

    /**
     * Return parent categories for a given type
     *
     * @param string $type
     * @return array
     */
    public function parents($type)
    {
        return $this->master->options($type, 0);
    }

}
