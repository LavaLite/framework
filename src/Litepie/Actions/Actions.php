<?php
namespace Litepie\Actions;

use Illuminate\Support\Arr;
use Litepie\Actions\Contracts\Actions as ActionsContract;

final class Actions implements ActionsContract
{
    private $actions = [];

    public function add(Action $action, string $name)
    {
        $this->actions[$name] = $action;
    }

    public function get(string $name)
    {
        $this->actions[$name];
    }

    public function action(string $name)
    {
        $this->get($name);
    }

    public function actions()
    {
        return $this->actions;
    }

    function list() {
        $actions = [];
        foreach ($this->actions() as $action) {
            if ($action->authorized() && $action->isType(ActionType::List)) {
                $actions[] = $action;
            }
        }
        return $actions;
    }

    public function details()
    {
        $actions = [];
        foreach ($this->actions() as $action) {
            if ($action->authorized() && $action->isType(ActionType::Details)) {
                $actions[] = $action;
            }
        }
        return $actions;
    }

    public function has(string $name)
    {
        if (isset($this->actions[$name])) {
            return true;
        }
        return false;
    }

    public function addFromArray(array $actions)
    {
        foreach ($actions as $key => $action) {
            $objAction = new Action($key);
            $objAction->roles(Arr::get($action, 'roles', []));
            $objAction->form(Arr::get($action, 'form', []));
            $objAction->type(Arr::get($action, 'type', []));
            $objAction->meta(Arr::get($action, 'meta', []));

            $this->add($objAction, $key);
        }
    }
}
