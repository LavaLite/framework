<?php

namespace Litepie\Calendar\Repositories\Presenter;

use Litepie\Repository\Presenter\FractalPresenter;

class CalendarListPresenter extends FractalPresenter {

    /**
     * Prepare data to present
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new CalendarListTransformer();
    }
}