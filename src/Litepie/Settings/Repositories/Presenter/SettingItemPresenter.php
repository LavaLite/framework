<?php

namespace Litepie\Settings\Repositories\Presenter;

use Litepie\Repository\Presenter\FractalPresenter;

class SettingItemPresenter extends FractalPresenter {

    /**
     * Prepare data to present
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new SettingItemTransformer();
    }
}