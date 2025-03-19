<?php

namespace Litepie\States\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Litepie\States\Exceptions\InvalidStartingStateException;
use Litepie\States\Models\PendingTransition;

class PendingTransitionExecutor implements ShouldQueue
{
    use InteractsWithQueue;
    use Queueable;
    use Dispatchable;
    use SerializesModels;

    public $pendingTransition;

    public function __construct(PendingTransition $pendingTransition)
    {
        $this->pendingTransition = $pendingTransition;
    }

    public function handle()
    {
        $field = $this->pendingTransition->field;
        $model = $this->pendingTransition->model;
        $from = $this->pendingTransition->from;
        $to = $this->pendingTransition->to;
        $customProperties = $this->pendingTransition->custom_properties;
        $responsible = $this->pendingTransition->responsible;

        if ($model->$field()->isNot($from)) {
            $exception = new InvalidStartingStateException(
                $expectedState = $from,
                $actualState = $model->$field()->state()
            );

            $this->fail($exception);

            return;
        }

        $model->$field()->transitionTo($to, $customProperties, $responsible);
    }
}
