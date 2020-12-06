<?php

namespace Litepie\Activities\Repositories\Presenter;

use Litepie\Repository\Presenter\FractalPresenter;

class ActivityLogPresenter extends FractalPresenter
{
    /**
     * Prepare data to present.
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ActivityLogTransformer();
    }
}
