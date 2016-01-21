<?php
namespace Litepie\Database\Contracts;

/**
 * Interface Presentable
 * @package Litepie\Database\Contracts
 */
interface Presentable
{
    /**
     * @param PresenterInterface $presenter
     * @return mixed
     */
    public function setPresenter(PresenterInterface $presenter);

    /**
     * @return mixed
     */
    public function presenter();
}