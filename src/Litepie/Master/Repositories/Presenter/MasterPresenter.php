<?php

namespace Litepie\Master\Repositories\Presenter;

use Litepie\Repository\Presenter\FractalPresenter;

class MasterPresenter extends FractalPresenter {

    /**
     * Prepare data to present
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new MasterTransformer();
    }
}