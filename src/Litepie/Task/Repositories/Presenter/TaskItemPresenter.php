<?php

namespace Litepie\Task\Repositories\Presenter;

use Litepie\Repository\Presenter\FractalPresenter;

class TaskItemPresenter extends FractalPresenter {

    /**
     * Prepare data to present
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new TaskItemTransformer();
    }
}