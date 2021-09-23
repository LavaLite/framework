<?php

namespace Litepie\Http\Controllers;

use Illuminate\Http\Request;
use Litepie\Http\Response\ResourceResponse;
use Litepie\Theme\ThemeAndViews;
use Litepie\User\Traits\RoutesAndGuards;

class ResourceController extends Controller
{
    use RoutesAndGuards;
    use ThemeAndViews;

    /**
     * @var store form for the module
     */
    public $form;

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
        $this->setGuard();
        $this->response = app(ResourceResponse::class);
        $this->middleware('auth:'.guard());
        $this->layout = 'app';
        $this->setTheme();
    }

    /**
     * Show dashboard for each user.
     *
     * @return \Illuminate\Http\Response
     */
    public function home(Request $request)
    {
        $user = $request->user()->toArray();

        return $this->response->setMetaTitle(__('Dashboard'))
            ->view('user.home')
            ->data(compact('user'))
            ->layout('user')
            ->output();
    }

    /**
     * Prepare the modules for the list.
     *
     * @var array  - Modules
     * @var string - Language  namespace
     *
     * @return array
     */
    public function modules($modules, $ns, $url = null, $seperator = '::')
    {
        $arr = [];
        $rUrl = request()->fullUrl();
        if (is_array($modules)) {
            foreach ($modules as $key => $module) {
                $arr[$key]['module'] = $module;
                $arr[$key]['name'] = trans("{$ns}{$seperator}{$module}.names");
                $arr[$key]['url'] = $url.'/'.$module;
                $arr[$key]['status'] = strpos($rUrl, $arr[$key]['url']) !== false ? 'active' : '';
                $arr[$key]['icon'] = trans("{$ns}{$seperator}{$module}.icon");
            }
        }

        return $arr;
    }
}
