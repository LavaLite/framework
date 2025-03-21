<?php

namespace Litepie\States\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Litepie\Database\Facades\ModelMacro;
use Litepie\States\Models\PendingTransition;
use Litepie\States\Models\StateHistory;
use Litepie\States\StateMachines\State;

/**
 * Trait HasState.
 *
 * @property array $stateMachines
 */
trait HasStateMachines
{
    public static function bootHasStateMachines()
    {
        $model = new static();

        collect($model->stateMachines)
            ->each(function ($_, $field) {
                ModelMacro::addMacro(static::class, $field, function () use ($field) {
                    $stateMachine = new $this->stateMachines[$field]($field, $this);

                    return new State($this->{$stateMachine->field}, $stateMachine);
                });

                $camelField = Str::of($field)->camel();

                ModelMacro::addMacro(static::class, $camelField, function () use ($field) {
                    $stateMachine = new $this->stateMachines[$field]($field, $this);

                    return new State($this->{$stateMachine->field}, $stateMachine);
                });

                $studlyField = Str::of($field)->studly();

                Builder::macro("whereHas{$studlyField}", function ($callable = null) use ($field) {
                    $model = $this->getModel();

                    if (!method_exists($model, 'stateHistory')) {
                        return $this->newQuery();
                    }

                    return $this->whereHas('stateHistory', function ($query) use ($field, $callable) {
                        $query->forField($field);
                        if ($callable !== null) {
                            $callable($query);
                        }

                        return $query;
                    });
                });
            });

        self::creating(function (Model $model) {
            $model->initStates();
        });

        self::created(function (Model $model) {
            collect($model->stateMachines)
                ->each(function ($_, $field) use ($model) {
                    $currentState = $model->$field;
                    $stateMachine = $model->$field()->stateMachine();

                    if ($currentState === null) {
                        return;
                    }

                    if (!$stateMachine->recordHistory()) {
                        return;
                    }

                    $responsible = auth()->user();

                    $changedAttributes = $model->getChangedAttributes();

                    $model->recordState($field, null, $currentState, [], $responsible, $changedAttributes);
                });
        });
    }

    public function getChangedAttributes(): array
    {
        return collect($this->getDirty())
            ->mapWithKeys(function ($_, $attribute) {
                return [
                    $attribute => [
                        'new' => data_get($this->getAttributes(), $attribute),
                        'old' => data_get($this->getOriginal(), $attribute),
                    ],
                ];
            })
            ->toArray();
    }

    public function initStates()
    {
        collect($this->stateMachines)
            ->each(function ($stateMachineClass, $field) {
                $stateMachine = new $stateMachineClass($field, $this);

                $this->{$field} = $this->{$field} ?? $stateMachine->defaultState();
            });
    }

    public function stateHistory()
    {
        return $this->morphMany(StateHistory::class, 'model');
    }

    public function pendingTransitions()
    {
        return $this->morphMany(PendingTransition::class, 'model');
    }

    public function recordState($field, $from, $to, $customProperties = [], $responsible = null, $changedAttributes = [])
    {
        $stateHistory = StateHistory::make([
            'field'              => $field,
            'from'               => $from,
            'to'                 => $to,
            'custom_properties'  => $customProperties,
            'changed_attributes' => $changedAttributes,
        ]);

        if ($responsible !== null) {
            $stateHistory->responsible()->associate($responsible);
        }

        $this->stateHistory()->save($stateHistory);
    }

    public function recordPendingTransition($field, $from, $to, $when, $customProperties = [], $responsible = null): PendingTransition
    {
        /** @var PendingTransition $pendingTransition */
        $pendingTransition = PendingTransition::make([
            'field'             => $field,
            'from'              => $from,
            'to'                => $to,
            'transition_at'     => $when,
            'custom_properties' => $customProperties,
        ]);

        if ($responsible !== null) {
            $pendingTransition->responsible()->associate($responsible);
        }

        $pendingTransition = $this->pendingTransitions()->save($pendingTransition);

        return $pendingTransition;
    }

    public function transitions()
    {
        return [];
    }
}
