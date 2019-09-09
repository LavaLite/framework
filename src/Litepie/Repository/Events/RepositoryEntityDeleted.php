<?php
namespace Litepie\Repository\Events;

/**
 * Class RepositoryEntityDeleted
 * @package Litepie\Repository\Events
 * @author Renfos Technologies Pvt. Ltd. <info@info@renfos.com>
 */
class RepositoryEntityDeleted extends RepositoryEventBase
{
    /**
     * @var string
     */
    protected $action = "deleted";
}
