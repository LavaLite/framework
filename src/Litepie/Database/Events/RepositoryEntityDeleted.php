<?php
namespace Litepie\Database\Events;

/**
 * Class RepositoryEntityDeleted
 * @package Litepie\Database\Events
 */
class RepositoryEntityDeleted extends RepositoryEventBase
{
    /**
     * @var string
     */
    protected $action = "deleted";
}