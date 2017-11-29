<?php

namespace Litepie\Message\Repositories\Criteria;

use Litepie\Repository\Contracts\CriteriaInterface;
use Litepie\Repository\Contracts\RepositoryInterface;

class MessageResourceCriteria implements CriteriaInterface
{
    public $folder = null;
    public $label  = null;
    public $readed = 1;

    public function __construct($folder = null, $label = null, $readed = 0)
    {
        $this->folder = $folder;
        $this->label  = $label;
        $this->readed = $readed;
    }

    public function apply($model, RepositoryInterface $repository)
    {
        $this->folder = request()->input('folder', $this->folder);
        $this->label  = request()->input('label', $this->label);
        $this->readed = request()->input('readed', $this->readed);

        if (in_array($this->folder, ['Sent', 'Draft', 'Outbox'])) {
            $model = $model
                ->whereFromId(user_id())
                ->whereFromType(user_type());
        } else {
            $model = $model
                ->whereToId(user_id())
                ->whereToType(user_type());
        }

        if (!empty($this->folder)) {
            $model = $model->whereFolder($this->folder);
        }

        if (!empty($this->label)) {
            $model = $model->where('labels', 'LIKE', $this->label);
        }

        if ($this->readed) {
            $model = $model->whereReaded(0);
        }

        return $model;
    }

}
