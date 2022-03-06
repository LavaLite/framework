<?php

namespace Litepie\Master;

use Litepie\Master\Interfaces\MasterRepositoryInterface;

class Master
{
    /**
     * Constructor.
     */
    public function __construct(
        MasterRepositoryInterface $master
    ) {
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
}
