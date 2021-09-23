<?php

namespace Litepie\Notification\Repositories\Presenter;

use Litepie\Repository\Presenter\FractalPresenter;

class NotificationListPresenter extends FractalPresenter
{
    /**
     * Prepare data to present.
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new NotificationListTransformer();
    }
}
