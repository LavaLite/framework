<?php

namespace Litepie\Notification\Traits;

use Litepie\Notification\Notifier;

trait SendNotification
{
    public function notifyAction()
    {
        $params = $this->getNotificationParameters();

        if (empty($params)) {
            return;
        }

        foreach($params as $param) {
            app(Notifier::class)
                ->model($this->getNotificationModel())
                ->initiate($param)
                ->send();
        }
    }

    public function notifyWorkflow()
    {
        $params = $this->getNotificationParameters();
        if (empty($params)) {
            return;
        }
        foreach($params as $param) {
            app(Notifier::class)
                ->model($this->getNotificationModel())
                ->initiate($param)
                ->send();
        }
    }

    private function getNotificationParameters($type = 'action')
    {
        if ($type == 'action') {
            $config = $this->namespace . '.actions.' . $this->action . '.notify';
        } elseif ($type == 'workflow') {
            $config = $this->namespace . '.workflow.' . $this->transition . '.notify';
        }
        return config($config, []);
    }

    private function getNotificationModel()
    {
        return $this->model;
    }

}
