<?php

namespace Litepie\Notification;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notification as IlluninateNotification;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Notification;

class Notifier
{
    private $users = [];

    private $notifier;

    private $model;

    private $view;

    private $layout = 'email';

    private $parameters = [];

    public function send()
    {
        if (empty($this->users)) {
            return;
        }
        Notification::send($this->users, $this->notifier);
    }

    public function initiate($config)
    {
        if (empty($config)) {
            return $this;
        }
        $this->setNotifier(new $config['notifier']($this->model));
        $this->addUsers($config['to']);
        return $this;
    }

    public function addUser(Model $user)
    {
        $this->users[] = $user;
        return $this;
    }

    public function addUsers(array $tos)
    {
        foreach ($tos as $key => $relation) {

            if ($key == 'user') {
                $this->addModelUsers($relation);
            } else {
                $this->addRelatedUsers($key, $relation);
            }
        }

    }
    private function addModelUsers(array | null $relations)
    {
        if (empty($relations)) {
            return;
        }

        foreach ($relations as $relation) {
            $users = $this->model->{$relation};
            if ($users instanceof Collection) {
                foreach ($users as $user) {
                    $this->addUser($user);
                }
            } else if ($users instanceof Model) {
                $this->addUser($users);
            }
        }
    }

    private function addRelatedUsers($relation, array | null $roles)
    {
        if (empty($roles)) {
            return;
        }
        $relation = $users = $this->model->{$relation};
        if (is_null($relation)) {
            return;
        }
        $users = $relation->whereIn('type', $roles);
        if ($users instanceof Collection) {
            foreach ($users as $user) {
                $this->addUser($user);
            }
        } else if ($users instanceof Model) {
            $this->addUser($users);
        }

    }

    public function setNotifier(IlluninateNotification $notifier)
    {
        $this->notifier = $notifier;
        return $this;
    }

    public function parameters(null | array $parameters = null)
    {
        if (is_null($parameters)) {
            return $this->parameters;
        }

        $this->parameters = $parameters;
        return $this;
    }

    public function model(null | Model $model = null)
    {
        if (is_null($model)) {
            return $this->model;
        }

        $this->model = $model;
        return $this;
    }

    public function view(null | string $view = null)
    {
        if (is_null($view)) {
            return $this->view;
        }

        $this->view = $view;
        return $this;
    }
    /**
     *
     */
    public function layout(null | string $layout = null)
    {
        if (is_null($layout)) {
            return $this->layout;
        }

        $this->layout = $layout;
        return $this;
    }

}
