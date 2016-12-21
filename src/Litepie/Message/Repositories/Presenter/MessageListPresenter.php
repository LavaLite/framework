<?php

namespace Litepie\Message\Repositories\Presenter;

use Litepie\Repository\Presenter\FractalPresenter;

class MessageListPresenter extends FractalPresenter {

    /**
     * Prepare data to present
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new MessageListTransformer();
    }
}