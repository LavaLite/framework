<?php

namespace Litepie\Revision\Repositories\Presenter;

use Litepie\Repository\Presenter\FractalPresenter;

class RevisionItemPresenter extends FractalPresenter {

    /**
     * Prepare data to present
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new RevisionItemTransformer();
    }
}