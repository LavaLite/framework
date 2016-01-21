<?php
namespace Litepie\Database\Contracts;

/**
 * Interface Transformable
 * @package Litepie\Database\Contracts
 */
interface Transformable
{
    /**
     * @return array
     */
    public function transform();
}