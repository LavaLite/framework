<?php

namespace Litepie\Menu\Repositories\Presenter;

use Litepie\Repository\Presenter\FractalPresenter;

class MenuListPresenter extends FractalPresenter
{
    /**
     * Prepare data to present.
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new MenuListTransformer();
    }
}
