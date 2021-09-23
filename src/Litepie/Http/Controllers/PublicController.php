<?php

namespace Litepie\Http\Controllers;

use Litepie\Http\Response\PublicResponse;
use Litepie\Theme\ThemeAndViews;
use Litepie\User\Traits\RoutesAndGuards;

class PublicController extends Controller
{
    use ThemeAndViews;
    use RoutesAndGuards;

    /**
     * @var store other modules in the package
     */
    public $modules;

    /**
     * Initialize public controller.
     *
     * @return null
     */
    public function __construct()
    {
        $this->response = app(PublicResponse::class);
        $this->setTheme(config('theme.themes.public.theme'));
    }

    /**
     * Prepare the modules for the list.
     *
     * @var array  - Modules
     * @var string - Language  namespace
     *
     * @return array
     */
    public function modules($modules, $ns, $url = null)
    {
        $arr = [];
        $rUrl = request()->fullUrl();
        foreach ($modules as $key => $module) {
            $arr[$key]['module'] = $module;
            $arr[$key]['name'] = trans("{$ns}::{$module}.names");
            $arr[$key]['url'] = $url.'/'.$module;
            $arr[$key]['status'] = strpos($rUrl, $arr[$key]['url']) !== false ? 'active' : '';
            $arr[$key]['icon'] = trans("{$ns}::{$module}.icon");
        }

        return $arr;
    }
}
