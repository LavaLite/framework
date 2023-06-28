<?php

namespace Litepie\Role;
use Litepie\Role\Actions\RoleActions;

class Role
{
    

    /**
     * Constructor.
     */
    public function __construct()
    {
        
    }

        /**
     * Returns count of role.
     *
     * @param array $filter
     *
     * @return int
     */
    public function select($request = [])
    {
        return RoleActions::run('select', $request);
    }
}
