<?php

namespace Litepie\Roles\Models;

use Litepie\Database\Model;
use Litepie\Database\Traits\Slugger;
use Litepie\Hashids\Traits\Hashids;
use Litepie\Revision\Traits\Revision;
use Litepie\Roles\Interfaces\PermissionHasRelations as PermissionHasRelationsContract;
use Litepie\Roles\Traits\PermissionHasRelations;
use Litepie\Trans\Traits\Translatable;

class Permission extends Model implements PermissionHasRelationsContract
{
    use PermissionHasRelations, Hashids, Slugger, Translatable, Revision;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'slug', 'description', 'model'];

    /**
     * Create a new model instance.
     *
     * @param array $attributes
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        if ($connection = config('roles.connection')) {
            $this->connection = $connection;
        }

    }

}
