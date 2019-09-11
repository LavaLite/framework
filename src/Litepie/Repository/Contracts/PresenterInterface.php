<?php
namespace Litepie\Repository\Contracts;

/**
 * Interface PresenterInterface
 * @package Litepie\Repository\Contracts
 * @author Renfos Technologies Pvt. Ltd. <info@info@renfos.com>
 */
interface PresenterInterface
{
    /**
     * Prepare data to present
     *
     * @param $data
     *
     * @return mixed
     */
    public function present($data);
}
