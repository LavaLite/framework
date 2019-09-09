<?php
namespace Litepie\Repository\Contracts;

/**
 * Interface Presentable
 * @package Litepie\Repository\Contracts
 * @author Renfos Technologies Pvt. Ltd. <info@info@renfos.com>
 */
interface Presentable
{
    /**
     * @param PresenterInterface $presenter
     *
     * @return mixed
     */
    public function setPresenter(PresenterInterface $presenter);

    /**
     * @return mixed
     */
    public function presenter();
}
