<?php

namespace Litepie\Contracts\Menu;

interface MenuRepository
{
    public function getSubmenu($parent);

    public function rootMenues();
}
