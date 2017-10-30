<?php
namespace Litepie\Repository\Events;

/**
 * Class RepositoryEntityUpdated
 * @package Litepie\Repository\Events
 */
class RepositoryEntityUpdated extends RepositoryEventBase
{
    /**
     * @var string
     */
    protected $action = "updated";
}
