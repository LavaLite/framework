<?php

namespace Litepie\Revision\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Revision Model.
 *
 * @author Alexey Bobkov, Samuel Georges
 */
class Revision extends Eloquent
{
    /**
     * @var string The database table used by the model.
     */
    public $table = 'revisions';

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
