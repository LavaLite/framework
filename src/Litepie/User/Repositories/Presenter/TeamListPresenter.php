<?php

namespace Litepie\User\Repositories\Presenter;

use Litepie\Repository\Presenter\FractalPresenter;

class TeamListPresenter extends FractalPresenter {

    /**
     * Prepare data to present
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new TeamListTransformer();
    }
}