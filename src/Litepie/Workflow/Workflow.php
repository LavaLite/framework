<?php
namespace Litepie\Workflow;

use Illuminate\Contracts\Container\Container;
use Litepie\Contracts\Workflow\Workflow as WorkflowContract;
use  Litepie\Workflow\Action\Action;
use  Litepie\Workflow\Validate\Validator;
use  Litepie\Workflow\Notify\Notifier;

class Workflow implements WorkflowContract
{

    use Action, Validator, Notifier;

    /**
     * The container instance.
     *
     * @var \Illuminate\Contracts\Container\Container
     */
    protected $container;

    /**
     * Create a new gate instance.
     *
     * @param  \Illuminate\Contracts\Container\Container  $container
     * @return void
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }
}
