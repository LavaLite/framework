<?php

namespace Litepie\Team;

use Litepie\Team\Actions\TeamActions;

class Teams
{

    /**
     * Return select options team for the module.
     *
     * @param string $module
     * @param array $request
     *
     * @return array
     */
    public function options($module = 'team', $request = []): array
    {
        if ($module == 'team') {
            return TeamActions::run('options', $request);
        }
        return [];

    }
}
