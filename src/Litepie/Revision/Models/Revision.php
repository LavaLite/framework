<?php

namespace Litepie\Revision\Models;

use Litepie\Database\Model;
use Litepie\Repository\Traits\PresentableTrait;
/**
 * Revision Model.
 *
 * @author Alexey Bobkov, Samuel Georges
 */
class Revision extends Model
{
    use PresentableTrait;
    /**
     * @var string The database table used by the model.
     */
    public $table = 'revisions';
    /**
     * User morph to many relation.
     */
    public function user()
    {
        return $this->morphTo();
    }
    /**
     * Returns "new value" casted as the saved type.
     *
     * @return mixed
     */
    public function getNewValueAttribute($value)
    {

        if ($this->cast == 'date') {
            return $this->asDateTime($value);
        }

        return $value;
    }

    /**
     * Returns "old value" casted as the saved type.
     *
     * @return mixed
     */
    public function getOldValueAttribute($value)
    {

        if ($this->cast == 'date') {
            return $this->asDateTime($value);
        }

        return $value;
    }

}
