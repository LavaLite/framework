<?php

namespace Litepie\Block\Http\Controllers;

use App\Http\Controllers\Controller as BaseController;
use Form;
use Litepie\Block\Http\Requests\CategoryRequest;
use Litepie\Block\Interfaces\CategoryRepositoryInterface;
use Litepie\Block\Models\Category;

class CategoryUserController extends BaseController
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
     * Initialize category controller.
     *
     * @param type CategoryRepositoryInterface $category
     *
     * @return type
     */
    public function __construct(CategoryRepositoryInterface $category)
    {
        $this->middleware('web');
        $this->middleware('auth:web');
        $this->middleware('auth.active:web');
        $this->setupTheme(config('theme.themes.user.theme'), config('theme.themes.user.layout'));
        $this->repository = $category;
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(CategoryRequest $request)
    {
        $this->repository->pushCriteria(new \Litepie\Block\Repositories\Criteria\CategoryUserCriteria());
        $categories = $this->repository->scopeQuery(function ($query) {
            return $query->orderBy('id', 'DESC');
        })->paginate();

        $this->theme->prependTitle(trans('block::category.names') . ' :: ');

        return $this->theme->of('block::user.category.index', compact('categories'))->render();
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Category $category
     *
     * @return Response
     */
    public function show(CategoryRequest $request, Category $category)
    {
        Form::populate($category);

        return $this->theme->of('block::user.category.show', compact('category'))->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function create(CategoryRequest $request)
    {

        $category = $this->repository->newInstance([]);
        Form::populate($category);

        return $this->theme->of('block::user.category.create', compact('category'))->render();
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(CategoryRequest $request)
    {
        try {
            $attributes = $request->all();
            $attributes['user_id'] = user_id();
            $attributes['user_type'] = user_type();
            $category = $this->repository->create($attributes);

            return redirect(trans_url('/user/block/category'))
                ->with('message', trans('messages.success.created', ['Module' => trans('block::category.name')]))
                ->with('code', 201);

        } catch (Exception $e) {
            redirect()->back()->withInput()->with('message', $e->getMessage())->with('code', 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param Category $category
     *
     * @return Response
     */
    public function edit(CategoryRequest $request, Category $category)
    {

        Form::populate($category);

        return $this->theme->of('block::user.category.edit', compact('category'))->render();
    }

    /**
     * Update the specified resource.
     *
     * @param Request $request
     * @param Category $category
     *
     * @return Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        try {
            $this->repository->update($request->all(), $category->getRouteKey());

            return redirect(trans_url('/user/block/category'))
                ->with('message', trans('messages.success.updated', ['Module' => trans('block::category.name')]))
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
    public function destroy(CategoryRequest $request, Category $category)
    {
        try {
            $this->repository->delete($category->getRouteKey());
            return redirect(trans_url('/user/block/category'))
                ->with('message', trans('messages.success.deleted', ['Module' => trans('block::category.name')]))
                ->with('code', 204);

        } catch (Exception $e) {

            redirect()->back()->withInput()->with('message', $e->getMessage())->with('code', 400);

        }
    }
}
