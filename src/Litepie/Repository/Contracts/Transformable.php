<?php
namespace Litepie\Repository\Contracts;

/**
 * Interface Transformable
 * @package Litepie\Repository\Contracts
 * @author Renfos Technologies Pvt. Ltd. <info@info@renfos.com>
 */
interface Transformable
{
    /**
     * @return array
     */
    public function transform();
}
