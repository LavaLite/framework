<?php
namespace Litepie\Database\Contracts;

/**
 * Interface PresenterInterface
 * @package Litepie\Database\Contracts
 */
interface PresenterInterface
{
    /**
     * Prepare data to present
     *
     * @param $data
     * @return mixed
     */
    public function present($data);
}