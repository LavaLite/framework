<?php

namespace Litepie\Block\Http\Controller\Api;

use App\Http\Controllers\Controller as BaseController;
use Litepie\Block\Http\Requests\BlockUserApiRequest;
use Litepie\Block\Interfaces\BlockRepositoryInterface;
use Litepie\Block\Models\Block;

/**
 * User API controller class.
 */
class BlockUserController extends BaseController
{

    /**
     * The authentication guard that should be used.
     *
     * @var string
     */
    protected $guard = 'api';

    /**
     * Initialize block controller.
     *
     * @param type BlockRepositoryInterface $block
     *
     * @return type
     */
    public function __construct(BlockRepositoryInterface $block)
    {
        $this->middleware('api');
        $this->middleware('jwt.auth:api');
        $this->setupTheme(config('theme.themes.user.theme'), config('theme.themes.user.layout'));
        $this->repository = $block;
        parent::__construct();
    }

    /**
     * Display a list of block.
     *
     * @return json
     */
    public function index(BlockUserApiRequest $request)
    {
        $blocks = $this->repository
            ->pushCriteria(new \Litepie\Block\Repositories\Criteria\BlockUserCriteria())
            ->setPresenter('\\Litepie\\Block\\Repositories\\Presenter\\BlockListPresenter')
            ->scopeQuery(function ($query) {
                return $query->orderBy('id', 'DESC');
            })->all();
        $blocks['code'] = 2000;
        return response()->json($blocks)
            ->setStatusCode(200, 'INDEX_SUCCESS');

    }

    /**
     * Display block.
     *
     * @param Request $request
     * @param Model   Block
     *
     * @return Json
     */
    public function show(BlockUserApiRequest $request, Block $block)
    {

        if ($block->exists) {
            $block = $block->presenter();
            $block['code'] = 2001;
            return response()->json($block)
                ->setStatusCode(200, 'SHOW_SUCCESS');
        } else {
            return response()->json([])
                ->setStatusCode(400, 'SHOW_ERROR');
        }

    }

    /**
     * Show the form for creating a new block.
     *
     * @param Request $request
     *
     * @return json
     */
    public function create(BlockUserApiRequest $request, Block $block)
    {
        $block = $block->presenter();
        $block['code'] = 2002;
        return response()->json($block)
            ->setStatusCode(200, 'CREATE_SUCCESS');
    }

    /**
     * Create new block.
     *
     * @param Request $request
     *
     * @return json
     */
    public function store(BlockUserApiRequest $request)
    {
        try {
            $attributes = $request->all();
            $attributes['user_id'] = user_id('admin.api');
            $attributes['user_type'] = user_type();
            $block = $this->repository->create($attributes);
            $block = $block->presenter();
            $block['code'] = 2004;

            return response()->json($block)
                ->setStatusCode(201, 'STORE_SUCCESS');
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'code'    => 4004,
            ])->setStatusCode(400, 'STORE_ERROR');
        }

    }

    /**
     * Show block for editing.
     *
     * @param Request $request
     * @param Model   $block
     *
     * @return json
     */
    public function edit(BlockUserApiRequest $request, Block $block)
    {

        if ($block->exists) {
            $block = $block->presenter();
            $block['code'] = 2003;
            return response()->json($block)
                ->setStatusCode(200, 'EDIT_SUCCESS');
        } else {
            return response()->json([])
                ->setStatusCode(400, 'SHOW_ERROR');
        }

    }

    /**
     * Update the block.
     *
     * @param Request $request
     * @param Model   $block
     *
     * @return json
     */
    public function update(BlockUserApiRequest $request, Block $block)
    {
        try {

            $attributes = $request->all();

            $block->update($attributes);
            $block = $block->presenter();
            $block['code'] = 2005;

            return response()->json($block)
                ->setStatusCode(201, 'UPDATE_SUCCESS');

        } catch (Exception $e) {

            return response()->json([
                'message' => $e->getMessage(),
                'code'    => 4005,
            ])->setStatusCode(400, 'UPDATE_ERROR');

        }

    }

    /**
     * Remove the block.
     *
     * @param Request $request
     * @param Model   $block
     *
     * @return json
     */
    public function destroy(BlockUserApiRequest $request, Block $block)
    {

        try {

            $t = $block->delete();

            return response()->json([
                'message' => trans('messages.success.delete', ['Module' => trans('block::block.name')]),
                'code'    => 2006,
            ])->setStatusCode(202, 'DESTROY_SUCCESS');

        } catch (Exception $e) {

            return response()->json([
                'message' => $e->getMessage(),
                'code'    => 4006,
            ])->setStatusCode(400, 'DESTROY_ERROR');
        }

    }

}
