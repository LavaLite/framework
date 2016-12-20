<?php

namespace Litepie\Block\Repositories\Presenter;

use Litepie\Repository\Presenter\FractalPresenter;

class BlockItemPresenter extends FractalPresenter
{

    /**
     * Prepare data to present
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new BlockItemTransformer();
    }
}
