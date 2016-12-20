<?php

namespace Litepie\Block\Repositories\Presenter;

use Litepie\Repository\Presenter\FractalPresenter;

class CategoryItemPresenter extends FractalPresenter
{

    /**
     * Prepare data to present
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new CategoryItemTransformer();
    }
}
