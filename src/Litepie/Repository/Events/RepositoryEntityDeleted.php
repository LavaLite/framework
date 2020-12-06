<?php

namespace Litepie\Repository\Events;

/**
 * Class RepositoryEntityDeleted.
 *
 * @author Renfos Technologies Pvt. Ltd. <info@info@renfos.com>
 */
class RepositoryEntityDeleted extends RepositoryEventBase
{
    /**
     * @var string
     */
    protected $action = 'deleted';
}
