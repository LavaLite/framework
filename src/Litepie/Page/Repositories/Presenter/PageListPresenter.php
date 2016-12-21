<?php

namespace Litepie\Page\Repositories\Presenter;

use Litepie\Repository\Presenter\FractalPresenter;

class PageListPresenter extends FractalPresenter
{

    /**
     * Prepare data to present
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new PageListTransformer();
    }
}
