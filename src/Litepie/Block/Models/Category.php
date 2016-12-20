<?php

namespace Litepie\Block\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Litepie\Database\Model;
use Litepie\Database\Traits\Slugger;
use Litepie\Filer\Traits\Filer;
use Litepie\Hashids\Traits\Hashids;
use Litepie\Repository\Traits\PresentableTrait;
use Litepie\Revision\Traits\Revision;
use Litepie\Trans\Traits\Translatable;
use Litepie\User\Traits\User as UserModel;

class Category extends Model
{
    use Filer, SoftDeletes, Hashids, Slugger, Translatable, Revision, PresentableTrait, UserModel;

    /**
     * Configuartion for the model.
     *
     * @var array
     */
    protected $config = 'litepie.block.category';
    /**
     * The blog_categories that belong to the blog.
     */
    public function blocks()
    {
        return $this->hasMany('Litepie\Block\Models\Block', 'category_id');
    }

}
