<?php

namespace Litepie\Contracts\Database;

/**
 *  Presentable.
 */
interface Presentable
{
    /**
     * @param Presenter $presenter
     *
     * @return mixed
     */
    public function setPresenter(Presenter $presenter);

    /**
     * @return mixed
     */
    public function presenter();
}
