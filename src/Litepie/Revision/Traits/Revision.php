<?php

namespace Litepie\Revision\Traits;

use DateTime;
use DB;
use Exception;

trait Revision
{
    /**
     * @var array List of attributes to monitor for changes and store revisions for.
     */
    public $revision = [];

    /**
     * @var int Maximum number of revision records to keep.
     */
    public $revisionLimit = 500;

    /*
     * You can change the relation name used to store revisions:
     *
     * const REVISION_HISTORY = 'revision_history';
     */

    /**
     * @var bool Flag for arbitrarily disabling revision history.
     */
    public $revisionsEnabled = true;

    /**
     * Boot the revision trait for a model.
     *
     * @return void
     */
    public static function bootRevision()
    {
        if (!property_exists(get_called_class(), 'revision')) {
            throw new Exception(sprintf('You must define a $revision property in %s to use the Revision trait.', get_called_class()));
        }

        static::updated(function ($model) {
            $model->revisionAfterUpdate();
        });

        static::deleted(function ($model) {
            $model->revisionAfterDelete();
        });
    }

    public function revisionAfterUpdate()
    {
        if (!$this->revisionsEnabled) {
            return;
        }

        $relationObject = $this->revisionHistory();
        $revisionModel = $relationObject->getRelated();

        $toSave = [];
        $dirty = $this->getDirty();
        foreach ($dirty as $attribute => $value) {
            if (!in_array($attribute, $this->revision)) {
                continue;
            }

            $toSave[] = [
                'field'           => $attribute,
                'old_value'       => array_get($this->original, $attribute),
                'new_value'       => $value,
                'revision_type'   => $relationObject->getMorphClass(),
                'revision_id'     => $this->getKey(),
                'user_id'         => $this->getUserId(),
                'cast'            => $this->revisionGetCastType($attribute),
                'created_at'      => new DateTime(),
                'updated_at'      => new DateTime(),
            ];
        }

        // Nothing to do
        if (!count($toSave)) {
            return;
        }

        DB::table($revisionModel->getTable())->insert($toSave);
        $this->revisionCleanUp();
    }

    public function revisionAfterDelete()
    {
        if (!$this->revisionsEnabled) {
            return;
        }

        $softDeletes = in_array(
            'Illuminate\Database\Eloquent\SoftDeletes',
            class_uses_recursive(get_class($this))
        );

        if (!$softDeletes) {
            return;
        }

        if (!in_array('deleted_at', $this->revision)) {
            return;
        }

        $relationObject = $this->revisionHistory();
        $revisionModel = $relationObject->getRelated();

        $toSave = [
            'field'           => 'deleted_at',
            'old_value'       => null,
            'new_value'       => $this->deleted_at,
            'revision_type'   => $relationObject->getMorphClass(),
            'revision_id'     => $this->getKey(),
            'user_id'         => $this->getUserId(),
            'created_at'      => new DateTime(),
            'updated_at'      => new DateTime(),
        ];

        DB::table($revisionModel->getTable())->insert($toSave);
        $this->revisionCleanUp();
    }

    /*
     * Deletes revision records exceeding the limit.
     */

    protected function revisionCleanUp()
    {
        $relationObject = $this->revisionHistory();

        $revisionLimit = property_exists($this, 'revisionLimit')
            ? (int) $this->revisionLimit
            : 500;

        $toDelete = $relationObject
            ->orderBy('id')
            ->skip($revisionLimit)
            ->limit(64)
            ->get();

        foreach ($toDelete as $record) {
            $record->delete();
        }
    }

    protected function revisionGetCastType($attribute)
    {
        if (in_array($attribute, $this->getDates())) {
            return 'date';
        }
    }

    /**
     * Attempt to find the user id of the currently logged in user.
     **/
    public function getUserId()
    {
        try {
            return \Auth::user()->getAuthIdentifier();
        } catch (\Exception $e) {
            return;
        }
    }

    /**
     * @return mixed
     */
    public function revisionHistory()
    {
        return $this->morphMany('\Litepie\Revision\Models\Revision', 'revision');
    }
}
