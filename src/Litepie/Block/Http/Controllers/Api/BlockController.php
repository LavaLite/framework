<?php

namespace Litepie\Block\Http\Controller\Api;

use App\Http\Controllers\Controller as BaseController;
use Litepie\Block\Interfaces\BlockRepositoryInterface;
use Litepie\Block\Repositories\Presenter\BlockItemTransformer;

/**
 * Pubic API controller class.
 */
class BlockController extends BaseController
{

    /**
     * Constructor.
     *
     * @param type \Litepie\Block\Interfaces\BlockRepositoryInterface $block
     *
     * @return type
     */
    public function __construct(BlockRepositoryInterface $block)
    {
        $this->middleware('api');
        $this->repository = $block;
        parent::__construct();
    }

    /**
     * Show block's list.
     *
     * @param string $slug
     *
     * @return response
     */
    protected function index()
    {
        $blocks = $this->repository
            ->setPresenter('\\Litepie\\Block\\Repositories\\Presenter\\BlockListPresenter')
            ->scopeQuery(function ($query) {
                return $query->orderBy('id', 'DESC');
            })->paginate();

        $blocks['code'] = 2000;
        return response()->json($blocks)
            ->setStatusCode(200, 'INDEX_SUCCESS');
    }

    /**
     * Show block.
     *
     * @param string $slug
     *
     * @return response
     */
    protected function show($slug)
    {
        $block = $this->repository
            ->scopeQuery(function ($query) use ($slug) {
                return $query->orderBy('id', 'DESC')
                    ->where('slug', $slug);
            })->first(['*']);

        if (!is_null($block)) {
            $block = $this->itemPresenter($module, new BlockItemTransformer);
            $block['code'] = 2001;
            return response()->json($block)
                ->setStatusCode(200, 'SHOW_SUCCESS');
        } else {
            return response()->json([])
                ->setStatusCode(400, 'SHOW_ERROR');
        }

    }

}
