<?php
namespace Litepie\Database\Events;

/**
 * Class RepositoryEntityUpdated
 * @package Litepie\Database\Events
 */
class RepositoryEntityUpdated extends RepositoryEventBase
{
    /**
     * @var string
     */
    protected $action = "updated";
}