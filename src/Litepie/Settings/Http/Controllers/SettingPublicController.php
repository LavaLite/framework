<?php

namespace Litepie\Settings\Http\Controllers;

use App\Http\Controllers\PublicController as BaseController;
use Litepie\Settings\Interfaces\SettingRepositoryInterface;

class SettingPublicController extends BaseController
{
    // use SettingWorkflow;

    /**
     * Constructor.
     *
     * @param type \Litepie\Setting\Interfaces\SettingRepositoryInterface $setting
     *
     * @return type
     */
    public function __construct(SettingRepositoryInterface $setting)
    {
        $this->repository = $setting;
        parent::__construct();
    }

    /**
     * Show setting's list.
     *
     * @param string $slug
     *
     * @return response
     */
    protected function index()
    {
        $settings = $this->repository
        ->pushCriteria(app('Litepie\Repository\Criteria\RequestCriteria'))
        ->scopeQuery(function($query){
            return $query->orderBy('id','DESC');
        })->paginate();

        return $this->theme->of('settings::public.setting.index', compact('settings'))->render();
    }

    /**
     * Show setting.
     *
     * @param string $slug
     *
     * @return response
     */
    protected function show($slug)
    {
        $setting = $this->repository->scopeQuery(function($query) use ($slug) {
            return $query->orderBy('id','DESC')
                         ->where('slug', $slug);
        })->first(['*']);

        return $this->theme->of('settings::public.setting.show', compact('setting'))->render();
    }

}
