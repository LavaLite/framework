<?php

namespace Litepie\Page\Repositories\Presenter;

use Litepie\Repository\Presenter\FractalPresenter;

class PageShowPresenter extends FractalPresenter
{

    /**
     * Prepare data to present
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new PageShowTransformer();
    }
}
