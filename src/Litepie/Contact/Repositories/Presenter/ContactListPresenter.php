<?php

namespace Litepie\Contact\Repositories\Presenter;

use Litepie\Repository\Presenter\FractalPresenter;

class ContactListPresenter extends FractalPresenter {

    /**
     * Prepare data to present
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ContactListTransformer();
    }
}