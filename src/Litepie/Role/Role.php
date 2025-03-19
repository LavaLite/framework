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

    /**
     * Return select options role for the module.
     *
     * @param string $module
     * @param array  $request
     *
     * @return array
     */
    public function options($module = 'role', $request = []): array
    {
        if ($module == 'role') {
            return RoleActions::run('options', $request);
        }
    }
}
