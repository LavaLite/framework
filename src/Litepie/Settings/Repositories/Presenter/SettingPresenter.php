<?php

namespace Litepie\Settings\Repositories\Presenter;

use Litepie\Repository\Presenter\FractalPresenter;

class SettingPresenter extends FractalPresenter
{
    /**
     * Prepare data to present.
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new SettingTransformer();
    }
}
