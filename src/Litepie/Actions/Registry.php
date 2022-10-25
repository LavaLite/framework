<?php

namespace Litepie\Actions;

use Litepie\Actions\Contracts\Actions as ActionsContract;

/**
 * @author Fabien Potencier <fabien@symfony.com>
 * @author Grégoire Pineau <lyrixx@lyrixx.info>
 */
class Registry
{
    private $actions = [];

    public function add(ActionsContract $action, string $subject)
    {
        $this->actions[$subject] = $action;
    }

    public function has(string $subject): bool
    {
        if (isset($this->actions[$subject])) {
            return true;
        }
        return false;
    }

    public function get(string $subject): Actions | null
    {
        if (isset($this->actions[$subject])) {
            return $this->actions[$subject];
        }
        return null;
    }

    public function addFromArray(string $subject, array $actions)
    {
        $action = new Actions();
        $action->addFromArray($actions);
        $this->add($action, $subject);
    }
}
