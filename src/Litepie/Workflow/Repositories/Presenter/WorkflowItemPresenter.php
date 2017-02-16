<?php

namespace Litepie\Workflow\Repositories\Presenter;

use Litepie\Repository\Presenter\FractalPresenter;

class WorkflowItemPresenter extends FractalPresenter {

    /**
     * Prepare data to present
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new WorkflowItemTransformer();
    }
}