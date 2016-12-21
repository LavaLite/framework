<?php

namespace Litepie\Task\Repositories\Presenter;

use Litepie\Repository\Presenter\FractalPresenter;

class TaskListPresenter extends FractalPresenter {

    /**
     * Prepare data to present
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new TaskListTransformer();
    }
}