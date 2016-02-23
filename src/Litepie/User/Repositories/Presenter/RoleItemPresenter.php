<?php

namespace Lavalite\User\Repositories\Presenter;

use Litepie\Database\Presenter\FractalPresenter;

class RoleItemPresenter extends FractalPresenter {

    /**
     * Prepare data to present
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new RoleItemTransformer();
    }
}