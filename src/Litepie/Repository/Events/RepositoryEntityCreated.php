<?php

namespace Litepie\Repository\Events;

/**
 * Class RepositoryEntityCreated.
 *
 * @author Renfos Technologies Pvt. Ltd. <info@info@renfos.com>
 */
class RepositoryEntityCreated extends RepositoryEventBase
{
    /**
     * @var string
     */
    protected $action = 'created';
}
