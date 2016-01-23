<?php

namespace Litepie\Contracts\Database;

/**
 *  Presenter
 * @package Litepie\Contracts\Database
 */
interface Presenter
{
    /**
     * Prepare data to present
     *
     * @param $data
     * @return mixed
     */
    public function present($data);
}