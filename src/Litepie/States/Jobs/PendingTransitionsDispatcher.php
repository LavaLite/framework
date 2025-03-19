<?php

namespace Litepie\States\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Litepie\States\Models\PendingTransition;

class PendingTransitionsDispatcher implements ShouldQueue
{
    use InteractsWithQueue;
    use Queueable;
    use Dispatchable;
    use SerializesModels;

    public function handle()
    {
        PendingTransition::with(['model'])
            ->notApplied()
            ->onScheduleOrOverdue()
            ->get()
            ->each(function (PendingTransition $pendingTransition) {
                PendingTransitionExecutor::dispatch($pendingTransition);

                $pendingTransition->applied_at = now();
                $pendingTransition->save();
            });
    }
}
