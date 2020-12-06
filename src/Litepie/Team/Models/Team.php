<?php

namespace Litepie\Team\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Litepie\Database\Model;
use Litepie\Filer\Traits\Filer;
use Litepie\Hashids\Traits\Hashids;
use Litepie\Repository\Traits\PresentableTrait;
use Litepie\Trans\Traits\Translatable;

class Team extends Model
{
    use Filer;
    use SoftDeletes;
    use Hashids;
    use Translatable;
    use PresentableTrait;

    /**
     * Configuartion for the model.
     *
     * @var array
     */
    protected $config = 'teams.team.model';

    /**
     * The User that belong to the team.
     */
    public function users()
    {
        return $this->belongsToMany('App\Models\User')
            ->withPivot([
                'id', 'role',
            ]);
    }

    public function getManagersAttribute()
    {
        return $this->users()->where('role', 'manager')->get();
    }

    public function getAdminsAttribute()
    {
        return $this->users()->where('role', 'admin')->get();
    }
}
