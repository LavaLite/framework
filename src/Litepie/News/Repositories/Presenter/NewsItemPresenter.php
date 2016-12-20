<?php

namespace Litepie\News\Repositories\Presenter;

use Litepie\Repository\Presenter\FractalPresenter;

class NewsItemPresenter extends FractalPresenter {

    /**
     * Prepare data to present
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new NewsItemTransformer();
    }
}