<?php
namespace Litepie\Repository\Events;

/**
 * Class RepositoryEntityCreated
 * @package Litepie\Repository\Events
 */
class RepositoryEntityCreated extends RepositoryEventBase
{
    /**
     * @var string
     */
    protected $action = "created";
}
