<?php

namespace Litepie\Block\Http\Controllers;

use App\Http\Controllers\Controller as BasicController;
use Form;
use Litepie\Block\Http\Requests\BlockRequest;
use Litepie\Block\Interfaces\BlockRepositoryInterface;
use Litepie\Block\Models\Block;

class BlockUserController extends BasicController
{

    /**
     * The authentication guard that should be used.
     *
     * @var string
     */
    protected $guard = 'web';

    /**
     * The home page route of user.
     *
     * @var string
     */
    protected $home = 'home';

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
        $this->middleware('auth:web');
        $this->middleware('auth.active:web');
        $this->setupTheme(config('theme.themes.user.theme'), config('theme.themes.user.layout'));
        $this->repository = $block;
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(BlockRequest $request)
    {
        $this->repository->pushCriteria(new \Litepie\Block\Repositories\Criteria\BlockUserCriteria());
        $blocks = $this->repository->scopeQuery(function ($query) {
            return $query->orderBy('id', 'DESC');
        })->paginate();

        $this->theme->prependTitle(trans('block::block.names') . ' :: ');

        return $this->theme->of('block::user.block.index', compact('blocks'))->render();
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Block $block
     *
     * @return Response
     */
    public function show(BlockRequest $request, Block $block)
    {
        Form::populate($block);

        return $this->theme->of('block::user.block.show', compact('block'))->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function create(BlockRequest $request)
    {

        $block = $this->repository->newInstance([]);
        Form::populate($block);

        return $this->theme->of('block::user.block.create', compact('block'))->render();
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(BlockRequest $request)
    {
        try {
            $attributes = $request->all();
            $attributes['user_id'] = user_id();
            $attributes['user_type'] = user_type();
            $block = $this->repository->create($attributes);

            return redirect(trans_url('/user/block/block'))
                ->with('message', trans('messages.success.created', ['Module' => trans('block::block.name')]))
                ->with('code', 201);

        } catch (Exception $e) {
            redirect()->back()->withInput()->with('message', $e->getMessage())->with('code', 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param Block $block
     *
     * @return Response
     */
    public function edit(BlockRequest $request, Block $block)
    {

        Form::populate($block);

        return $this->theme->of('block::user.block.edit', compact('block'))->render();
    }

    /**
     * Update the specified resource.
     *
     * @param Request $request
     * @param Block $block
     *
     * @return Response
     */
    public function update(BlockRequest $request, Block $block)
    {
        try {
            $attributes = $request->all();
            $attributes['published'] = 'No';
            $this->repository->update($attributes, $block->getRouteKey());

            return redirect(trans_url('/user/block/block'))
                ->with('message', trans('messages.success.updated', ['Module' => trans('block::block.name')]))
                ->with('code', 204);

        } catch (Exception $e) {
            redirect()->back()->withInput()->with('message', $e->getMessage())->with('code', 400);
        }
    }

    /**
     * Remove the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy(BlockRequest $request, Block $block)
    {
        try {
            $this->repository->delete($block->getRouteKey());
            return response()->json([
                'message'  => trans('messages.success.deleted', ['Module' => trans('block::block.name')]),
                'code'     => 202,
                'redirect' => trans_url('/user/block/block'),
            ], 202);

        } catch (Exception $e) {

            redirect()->back()->withInput()->with('message', $e->getMessage())->with('code', 400);

        }
    }
}
