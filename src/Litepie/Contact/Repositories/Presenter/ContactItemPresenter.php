<?php

namespace Litepie\Contact\Repositories\Presenter;

use Litepie\Repository\Presenter\FractalPresenter;

class ContactItemPresenter extends FractalPresenter {

    /**
     * Prepare data to present
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ContactItemTransformer();
    }
}