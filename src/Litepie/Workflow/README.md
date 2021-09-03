Use the Symfony Workflow component in Laravel / Lavalite

### Installation

    composer require litepie/workflow

#### For laravel <= 5.4

Add a ServiceProvider to your providers array in `config/app.php`:

```php
<?php

'providers' => [
    ...
    Litepie\Workflow\WorkflowServiceProvider::class,

]
```

Add the `Workflow` facade to your facades array:

```php
<?php
    ...
    'Workflow' => Litepie\Workflow\Facades\WorkflowFacade::class,
```

### Configuration

Publish the config file

```
    php artisan vendor:publish --provider="Litepie\Workflow\WorkflowServiceProvider"
```

Configure your workflow in `config/workflow.php`

```php
<?php

return [
    'straight'   => [
        'type'          => 'workflow', // or 'state_machine'
        'marking_store' => [
            'type'      => 'multiple_state',
            'arguments' => ['currentPlace']
        ],
        'supports'      => ['Litepie\PackageR\BlogPost'],
        'places'        => ['draft', 'review', 'rejected', 'published'],
        'transitions'   => [
            'to_review' => [
                'from' => 'draft',
                'to'   => 'review'
            ],
            'publish' => [
                'from' => 'review',
                'to'   => 'published'
            ],
            'reject' => [
                'from' => 'review',
                'to'   => 'rejected'
            ]
        ],
    ]
];
```

Use the `WorkflowTrait` inside supported classes

```php
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Litepie\Workflow\Traits\WorkflowModalTrait;

class BlogPost extends Model
{
  use WorkflowModalTrait;

}
```
### Usage

####Using Facaces
```php
$post = BlogPost::find(1);
$workflow = Workflow::get($post);
// if more than one workflow is defined for the BlogPost class
$workflow = Workflow::get($post, $workflowName);

$workflow->can($post, 'publish'); // False
$workflow->can($post, 'to_review'); // True
$transitions = $workflow->getEnabledTransitions($post);

// Apply a transition
$workflow->apply($post, 'to_review');
$post->save(); // Don't forget to persist the state
```

####Using the WorkflowModalTrait
```php
$post->workflowCan('publish'); // True
$post->workflowCan('to_review'); // False

// Get the post transitions
foreach ($post->workflowTransitions() as $transition) {
    echo $transition->getName();
}

// Apply a transition
$post->workflowApply('publish');
```

### Use the events
This package provides a list of events fired during a transition

```php
    Litepie\Workflow\Events\Guard
    Litepie\Workflow\Events\Leave
    Litepie\Workflow\Events\Transition
    Litepie\Workflow\Events\Enter
    Litepie\Workflow\Events\Entered
```

You can subscribe to an event

```php
<?php

namespace Litepie\PackageR\Listeners;

class BlogPostWorkflowSubscriber
{
    /**
     * Handle workflow guard events.
     */
    public function onGuard(GuardEvent $event) {
        /** Symfony\Component\Workflow\Event\GuardEvent */
        $originalEvent = $event->getOriginalEvent();

        /** @var Litepie\PackageR\BlogPost $post */
        $post = $originalEvent->getSubject();
        $title = $post->title;

        if (empty($title)) {
            // Posts with no title should not be allowed
            $originalEvent->setBlocked(true);
        }
    }

    /**
     * Handle workflow leave event.
     */
    public function onLeave($event) {}

    /**
     * Handle workflow transition event.
     */
    public function onTransition($event) {}

    /**
     * Handle workflow enter event.
     */
    public function onEnter($event) {}

    /**
     * Handle workflow entered event.
     */
    public function onEntered($event) {}

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'Litepie\Workflow\Events\GuardEvent',
            'Litepie\PackageR\Listeners\BlogPostWorkflowSubscriber@onGuard'
        );

        $events->listen(
            'Litepie\Workflow\Events\LeaveEvent',
            'Litepie\PackageR\Listeners\BlogPostWorkflowSubscriber@onLeave'
        );

        $events->listen(
            'Litepie\Workflow\Events\TransitionEvent',
            'Litepie\PackageR\Listeners\BlogPostWorkflowSubscriber@onTransition'
        );

        $events->listen(
            'Litepie\Workflow\Events\EnterEvent',
            'Litepie\PackageR\Listeners\BlogPostWorkflowSubscriber@onEnter'
        );

        $events->listen(
            'Litepie\Workflow\Events\EnteredEvent',
            'Litepie\PackageR\Listeners\BlogPostWorkflowSubscriber@onEntered'
        );
    }

}
```

### Dump Workflows
Symfony workflow uses GraphvizDumper to create the workflow image. You may need to install the `dot` command of [Graphviz](http://www.graphviz.org/)

    php artisan workflow:dump workflow_name

You can change the image format with the `--format` option. By default the format is png.

    php artisan workflow:dump workflow_name --format=jpg
