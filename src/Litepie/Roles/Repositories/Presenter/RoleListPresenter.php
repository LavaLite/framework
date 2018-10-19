<?php

namespace Litepie\Roles\Repositories\Presenter;

use Litepie\Repository\Presenter\FractalPresenter;

class RoleListPresenter extends FractalPresenter
{
    /**
     * Prepare data to present.
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new RoleListTransformer();
    }
}
