<?php

namespace Litepie\Team;


use User;

class Teams
{
    

    /**
     * Constructor.
     */
    public function __construct()
    {
    }

    /**
     * Returns count of team.
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
     * Find team by slug.
     *
     * @param array $filter
     *
     * @return int
     */
    public function team($slug)
    {
        return  $this->team
            ->findBySlug($slug)
            ->toArray();
    }
}
