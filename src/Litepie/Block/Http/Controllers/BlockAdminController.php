<?php

namespace Litepie\Block\Http\Controllers;

use App\Http\Controllers\AdminController as BaseController;
use Form;
use Litepie\Block\Http\Requests\BlockRequest;
use Litepie\Block\Interfaces\BlockRepositoryInterface;
use Litepie\Block\Models\Block;


/**
 * Admin web controller class.
 */
class BlockAdminController extends BaseController
{

    /**
     * The authentication guard that should be used.
     *
     * @var string
     */
    public $guard = 'admin.web';

    /**
     * The home page route of admin.
     *
     * @var string
     */
    public $home = 'admin';

    /**
     * Initialize block controller.
     *
     * @param type BlockRepositoryInterface $block
     *
     * @return type
     */
    public function __construct(BlockRepositoryInterface $block)
    {
        $this->middleware('web');
        $this->middleware('auth:admin.web');
        $this->setupTheme(config('theme.themes.admin.theme'), config('theme.themes.admin.layout'));
        $this->repository = $block;
        parent::__construct();
    }

    /**
     * Display a list of block.
     *
     * @return Response
     */
    public function index(BlockRequest $request)
    {
        $pageLimit = $request->input('pageLimit');
        if ($request->wantsJson()) {
            $blocks = $this->repository
                ->setPresenter('\\Litepie\\Block\\Repositories\\Presenter\\BlockListPresenter')
                ->scopeQuery(function ($query) {
                    return $query->orderBy('id', 'DESC');
                })->paginate($pageLimit);

            $blocks['recordsTotal'] = $blocks['meta']['pagination']['total'];
            $blocks['recordsFiltered'] = $blocks['meta']['pagination']['total'];
            $blocks['request'] = $request->all();
            return response()->json($blocks, 200);

        }

        $this->theme->prependTitle(trans('block::block.names') . ' :: ');
        return $this->theme->of('block::admin.block.index')->render();
    }

    /**
     * Display block.
     *
     * @param Request $request
     * @param Model   $block
     *
     * @return Response
     */
    public function show(BlockRequest $request, Block $block)
    {

        if (!$block->exists) {
            return response()->view('block::admin.block.new', compact('block'));
        }

        Form::populate($block);
        return response()->view('block::admin.block.show', compact('block'));
    }

    /**
     * Show the form for creating a new block.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function create(BlockRequest $request)
    {

        $block = $this->repository->newInstance([]);

        Form::populate($block);

        return response()->view('block::admin.block.create', compact('block'));

    }

    /**
     * Create new block.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(BlockRequest $request)
    {
        try {
            $attributes = $request->all();
            $attributes['user_id'] = user_id('admin.web');
            $attributes['user_type'] = user_type();
            $block = $this->repository->create($attributes);

            return response()->json([
                'message'  => trans('messages.success.updated', ['Module' => trans('block::block.name')]),
                'code'     => 204,
                'redirect' => trans_url('/admin/block/block/' . $block->getRouteKey()),
            ], 201);

        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'code'    => 400,
            ], 400);
        }

    }

    /**
     * Show block for editing.
     *
     * @param Request $request
     * @param Model   $block
     *
     * @return Response
     */
    public function edit(BlockRequest $request, Block $block)
    {
        Form::populate($block);
        return response()->view('block::admin.block.edit', compact('block'));
    }

    /**
     * Update the block.
     *
     * @param Request $request
     * @param Model   $block
     *
     * @return Response
     */
    public function update(BlockRequest $request, Block $block)
    {
        try {

            $attributes = $request->all();

            $block->update($attributes);

            return response()->json([
                'message'  => trans('messages.success.updated', ['Module' => trans('block::block.name')]),
                'code'     => 204,
                'redirect' => trans_url('/admin/block/block/' . $block->getRouteKey()),
            ], 201);

        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 400,
                'redirect' => trans_url('/admin/block/block/' . $block->getRouteKey()),
            ], 400);

        }

    }

    /**
     * Remove the block.
     *
     * @param Model   $block
     *
     * @return Response
     */
    public function destroy(BlockRequest $request, Block $block)
    {

        try {

            $t = $block->delete();

            return response()->json([
                'message'  => trans('messages.success.deleted', ['Module' => trans('block::block.name')]),
                'code'     => 202,
                'redirect' => trans_url('/admin/block/block/0'),
            ], 202);

        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 400,
                'redirect' => trans_url('/admin/block/block/' . $block->getRouteKey()),
            ], 400);
        }

    }

}
