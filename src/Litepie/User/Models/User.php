<?php

namespace Litepie\User\Models;

use Hash;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Litepie\Database\Traits\Sluggable;
use Litepie\Filer\Traits\Filer;
use Litepie\Hashids\Traits\Hashids;
use Litepie\Repository\Traits\PresentableTrait;
use Litepie\Roles\Traits\HasRoleAndPermission;
use Litepie\User\Traits\User as UserProfile;
use Litepie\User\Interfaces\UserPolicyInterface;

class User extends Model implements UserPolicyInterface
{
    use Filer, Notifiable, HasRoleAndPermission, UserProfile, SoftDeletes, Hashids, Sluggable, PresentableTrait;

    /**
     * Configuartion for the model.
     *
     * @var array
     */
    protected $config = 'users.user.model';

    /**
     * Initialiaze page modal.
     *
     * @var attributes
     */
    public function __construct($attributes = [])
    {
        $config = config($this->config);

        foreach ($config as $key => $val) {
            if (property_exists(get_called_class(), $key)) {
                $this->$key = $val;
            }
        }

        parent::__construct($attributes);
    }

    /**
     * The User that belong to the team.
     */
    public function teams()
    {
        return $this->belongsToMany('Litepie\Team\Models\Team')
            ->withPivot([
                'id', 'role',
            ]);
    }
<<<<<<< Updated upstream
=======

    public function teamOptions($key, $value)
    {
        return $this->team->options($key, $value);
    }

    public function getAllUserById($team_id)
    {
        return $this->team->getAllUserForOpporunity($team_id);
    }

    /**
     * get options for various fields
     * @return [key] [name]
     */
    public function leadCountIncrement($user_id, $team_id)
    {
        return $this->team->leadCountIncrement($user_id, $team_id);
    }
 
    /**
     * get options for various fields
     * @return [key] [name]
     */
    public function getUserIdByName($name)
    {
        return $this->user->userIdByName($name);
    }
>>>>>>> Stashed changes
}
