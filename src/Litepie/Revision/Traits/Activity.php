<?php

namespace Litepie\Revision\Traits;

use DateTime;
use DB;
use Exception;

trait Activity
{
    /**
     * @var array List of attributes to monitor for changes and store activitys for.
     */
    public $activity = [];

    /**
     * @var int Maximum number of activity records to keep.
     */
    public $activityLimit = 500;

/*
 * You can change the relation name used to store activitys:
 *
 * const REVISION_HISTORY = 'activity_history';
 */

    /**
     * @var bool Flag for arbitrarily disabling activity history.
     */
    public $activitysEnabled = true;

    /**
     * Boot the activity trait for a model.
     *
     * @return void
     */
    public static function bootActivity()
    {
        if (!property_exists(get_called_class(), 'activity')) {
            throw new Exception(sprintf('You must define a $activity property in %s to use the Revision trait.', get_called_class()));
        }

        static::created(function ($model) {
            $model->activityAfterCreate();
        });

        static::updated(function ($model) {
            $model->activityAfterUpdate();
        });

        static::deleted(function ($model) {
            $model->activityAfterDelete();
        });
    }

    public function activityAfterCreate()
    {
        if (!$this->activitysEnabled) {
            return;
        }

        $relationObject = $this->activityHistory();
        $activityModel  = $relationObject->getRelated();
        
        $user_info['remote_addr'] = $_SERVER['REMOTE_ADDR'];
        $user_info['user_agent'] = $_SERVER['HTTP_USER_AGENT'];

        $toSave   = [
            'action'        => 'Created',
            'activity_type' => $relationObject->getMorphClass(),
            'activity_id'   => $this->getKey(),
            'user_id'       => $this->getActivityUserId(),
            'user_type'     => $this->getActivityUserType(),
            'name'          => $this->title,
            'user_info'     => json_encode($user_info),
            'created_at'    => new DateTime(),
        ];
        if (empty($toSave)) {
            // Nothing to do
            return;
        }

        DB::table($activityModel->getTable())->insert($toSave);
        $this->activityCleanUp();
    }

    public function activityAfterUpdate()
    {
        if (!$this->activitysEnabled) {
            return;
        }

        $relationObject = $this->activityHistory();
        $activityModel  = $relationObject->getRelated();

        $user_info['remote_addr'] = $_SERVER['REMOTE_ADDR'];
        $user_info['user_agent'] = $_SERVER['HTTP_USER_AGENT'];

        $toSave   = [
            'action'        => 'Updated',
            'activity_type' => $relationObject->getMorphClass(),
            'activity_id'   => $this->getKey(),
            'user_id'       => $this->getActivityUserId(),
            'user_type'     => $this->getActivityUserType(),
            'name'          => $this->title,
            'user_info'     => json_encode($user_info),
            'created_at'    => new DateTime(),
        ];
        if (empty($toSave)) {
            // Nothing to do
            return;
        }

        DB::table($activityModel->getTable())->insert($toSave);
        $this->activityCleanUp();
    }

    public function activityAfterDelete()
    {
        if (!$this->activitysEnabled) {
            return;
        }

        $softDeletes = in_array(
            'Illuminate\Database\Eloquent\SoftDeletes',
            class_uses_recursive(get_class($this))
        );

        if (!$softDeletes) {
            return;
        }

        $relationObject = $this->activityHistory();
        $activityModel  = $relationObject->getRelated();

        $user_info['remote_addr'] = $_SERVER['REMOTE_ADDR'];
        $user_info['user_agent'] = $_SERVER['HTTP_USER_AGENT'];

        $toSave = [
            'action'        => 'Deleted',
            'activity_type' => $relationObject->getMorphClass(),
            'activity_id'   => $this->getKey(),
            'user_id'       => $this->getActivityUserId(),
            'user_type'     => $this->getActivityUserType(),
            'name'          => $this->title,
            'created_at'    => new DateTime(),
        ];

        DB::table($activityModel->getTable())->insert($toSave);
        $this->activityCleanUp();
    }

    /*
     * Deletes activity records exceeding the limit.
     */

    protected function activityCleanUp()
    {
        $relationObject = $this->activityHistory();

        $activityLimit = property_exists($this, 'activityLimit')
        ? (int) $this->activityLimit
        : 500;

        $toDelete = $relationObject
            ->orderBy('id')
            ->skip($activityLimit)
            ->limit(64)
            ->get();

        foreach ($toDelete as $record) {
            $record->delete();
        }

    }

    protected function activityGetCastType($attribute)
    {

        if (in_array($attribute, $this->getDates())) {
            return 'date';
        }

    }

    /**
     * Attempt to find the user id of the currently logged in user.
     **/
    public function getActivityUserId()
    {
        try {
            return users('id', $this->getGuard());
        } catch (\Exception $e) {
            return;
        }

    }

    /**
     * Attempt to find the user model.
     **/
    public function getActivityUserType()
    {
        $user = user(config('auth.guard'));
        return get_class($user);
    }

    /**
     * @return mixed
     */
    public function activityHistory()
    {
        return $this->morphMany('\Litepie\Revision\Models\Activity', 'activity');
    }

    /**
     * Return the current guard.
     *
     * @return string
     */
    public function getActivityGuard()
    {
        return config('auth.guard');
    }


}
