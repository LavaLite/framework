<?php

namespace Litepie\User\Repositories\Presenter;

use Litepie\Repository\Presenter\FractalPresenter;

class RoleItemPresenter extends FractalPresenter
{
    /**
     * Prepare data to present.
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new RoleItemTransformer();
    }
}
