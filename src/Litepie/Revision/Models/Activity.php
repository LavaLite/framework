<?php

namespace Litepie\Revision\Models;

use Litepie\Database\Model;
use Litepie\Repository\Traits\PresentableTrait;
/**
 * Activity Model.
 *
 * @author Alexey Bobkov, Samuel Georges
 */
class Activity extends Model
{
    use PresentableTrait;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'activities';
    /**
     * User morph to many relation.
     */
    public function user()
    {
        return $this->morphTo();
    }

    /**
     * User morph to many relation.
     */
    public function activity()
    {
        return $this->morphTo();
    }

    /**
     * Returns "user info" casted as the saved type.
     *
     * @return mixed
     */
    public function getUserInfoAttribute($value)
    {

        if ($value == null || empty($value)) return '';

        return json_decode($value, true);
    }
}
