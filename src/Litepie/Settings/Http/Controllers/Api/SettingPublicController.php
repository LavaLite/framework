<?php

namespace Litepie\Settings\Http\Controllers\Api;

use App\Http\Controllers\Api\PublicController as BaseController;
use Litepie\Settings\Interfaces\SettingRepositoryInterface;
use Litepie\Settings\Repositories\Presenter\SettingItemTransformer;

/**
 * Pubic API controller class.
 */
class SettingPublicController extends BaseController
{
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
            ->setPresenter('\\Litepie\\Settings\\Repositories\\Presenter\\SettingListPresenter')
            ->scopeQuery(function($query){
                return $query->orderBy('id','DESC');
            })->paginate();

        $settings['code'] = 2000;
        return response()->json($settings)
                ->setStatusCode(200, 'INDEX_SUCCESS');
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
        $setting = $this->repository
            ->scopeQuery(function($query) use ($slug) {
            return $query->orderBy('id','DESC')
                         ->where('slug', $slug);
        })->first(['*']);

        if (!is_null($setting)) {
            $setting         = $this->itemPresenter($module, new SettingItemTransformer);
            $setting['code'] = 2001;
            return response()->json($setting)
                ->setStatusCode(200, 'SHOW_SUCCESS');
        } else {
            return response()->json([])
                ->setStatusCode(400, 'SHOW_ERROR');
        }

    }
}
