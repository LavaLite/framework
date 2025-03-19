<?php

namespace Litepie\States\StateMachines;

use Carbon\Carbon;
use Litepie\States\Exceptions\TransitionNotAllowedException;
use Litepie\States\Models\PendingTransition;
use Litepie\States\Models\StatseHistory;

/**
 * Class State.
 *
 * @property string $state
 * @property States $stateMachine
 */
class State
{
    public $state;
    public $stateMachine;

    public function __construct($state, $stateMachine)
    {
        $this->state = $state;
        $this->stateMachine = $stateMachine;
    }

    public function state()
    {
        return $this->state;
    }

    public function stateMachine()
    {
        return $this->stateMachine;
    }

    public function is($state)
    {
        return $this->state === $state;
    }

    public function isNot($state)
    {
        return !$this->is($state);
    }

    public function was($state)
    {
        return $this->stateMachine->was($state);
    }

    public function timesWas($state)
    {
        return $this->stateMachine->timesWas($state);
    }

    public function whenWas($state)
    {
        return $this->stateMachine->whenWas($state);
    }

    public function snapshotWhen($state)
    {
        return $this->stateMachine->snapshotWhen($state);
    }

    public function snapshotsWhen($state)
    {
        return $this->stateMachine->snapshotsWhen($state);
    }

    public function history()
    {
        return $this->stateMachine->history();
    }

    public function canBe($state)
    {
        return $this->stateMachine->canBe($from = $this->state, $to = $state);
    }

    public function pendingTransitions()
    {
        return $this->stateMachine->pendingTransitions();
    }

    public function hasPendingTransitions()
    {
        return $this->stateMachine->hasPendingTransitions();
    }

    public function transitionTo($state, $customProperties = [], $responsible = null)
    {
        $this->stateMachine->transitionTo(
            $from = $this->state,
            $to = $state,
            $customProperties,
            $responsible
        );
    }

    /**
     * @param        $state
     * @param Carbon $when
     * @param array  $customProperties
     * @param null   $responsible
     *
     * @throws TransitionNotAllowedException
     *
     * @return null|PendingTransition
     */
    public function postponeTransitionTo($state, Carbon $when, $customProperties = [], $responsible = null): ?PendingTransition
    {
        return $this->stateMachine->postponeTransitionTo(
            $from = $this->state,
            $to = $state,
            $when,
            $customProperties,
            $responsible
        );
    }

    public function latest(): ?StatseHistory
    {
        return $this->snapshotWhen($this->state);
    }

    public function getCustomProperty($key)
    {
        return optional($this->latest())->getCustomProperty($key);
    }

    public function responsible()
    {
        return optional($this->latest())->responsible;
    }

    public function allCustomProperties()
    {
        return optional($this->latest())->allCustomProperties();
    }

    public function nextTransitions(): array
    {
        return $this->stateMachine()->nextTransitions();
    }
}
