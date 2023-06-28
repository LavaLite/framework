<?php

namespace Litepie\Log;


use User;

class Logs
{
    

    /**
     * Constructor.
     */
    public function __construct()
    {
        
    }

    /**
     * Returns count of log.
     *
     * @param array $filter
     *
     * @return int
     */
    public function count()
    {
        return  0;
    }

    /**
     * Find log by slug.
     *
     * @param array $filter
     *
     * @return int
     */
    public function log($slug)
    {
        return  $this->log
            ->findBySlug($slug)
            ->toArray();
    }
}
