<?php

namespace Litepie\Notification\Repositories\Presenter;

use Litepie\Repository\Presenter\FractalPresenter;

class NotificationItemPresenter extends FractalPresenter
{
    /**
     * Prepare data to present.
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new NotificationItemTransformer();
    }
}
