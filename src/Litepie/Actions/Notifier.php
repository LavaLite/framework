<?php
namespace Litepie\Actions;

class Notifier
{
    protected $class = null;
    protected $users = null;

    public function __construct(array $notifyer, array $users)
    {
        $this->class = $notifyer;
        $this->users = $users;
    }
}
