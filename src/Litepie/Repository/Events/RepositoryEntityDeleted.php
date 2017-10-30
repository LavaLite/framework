<?php
namespace Litepie\Repository\Events;

/**
 * Class RepositoryEntityDeleted
 * @package Litepie\Repository\Events
 */
class RepositoryEntityDeleted extends RepositoryEventBase
{
    /**
     * @var string
     */
    protected $action = "deleted";
}
