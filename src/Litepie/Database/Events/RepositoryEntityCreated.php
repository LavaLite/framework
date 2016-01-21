<?php
namespace Litepie\Database\Events;

/**
 * Class RepositoryEntityCreated
 * @package Litepie\Database\Events
 */
class RepositoryEntityCreated extends RepositoryEventBase
{
    /**
     * @var string
     */
    protected $action = "created";
}