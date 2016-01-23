<?php
namespace Litepie\Contracts\Database;

/**
 *  Transformable
 * @package Litepie\Contracts\Database
 */
interface Transformable
{
    /**
     * @return array
     */
    public function transform();
}