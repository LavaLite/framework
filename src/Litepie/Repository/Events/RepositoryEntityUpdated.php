<?php
namespace Litepie\Repository\Events;

/**
 * Class RepositoryEntityUpdated
 * @package Litepie\Repository\Events
 * @author Renfos Technologies Pvt. Ltd. <info@info@renfos.com>
 */
class RepositoryEntityUpdated extends RepositoryEventBase
{
    /**
     * @var string
     */
    protected $action = "updated";
}
