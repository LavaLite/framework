<?php

namespace Litepie\Block\Http\Controllers;

use App\Http\Controllers\AdminController as BaseController;
use Form;
use Litepie\Block\Http\Requests\CategoryRequest;
use Litepie\Block\Interfaces\CategoryRepositoryInterface;
use Litepie\Block\Models\Category;

/**
 * Admin web controller class.
 */
class CategoryAdminController extends BaseController
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
     * Initialize category controller.
     *
     * @param type CategoryRepositoryInterface $category
     *
     * @return type
     */
    public function __construct(CategoryRepositoryInterface $category)
    {
        $this->middleware('web');
        $this->middleware('auth:admin.web');
        $this->setupTheme(config('theme.themes.admin.theme'), config('theme.themes.admin.layout'));
        $this->repository = $category;
        parent::__construct();
    }

    /**
     * Display a list of category.
     *
     * @return Response
     */
    public function index(CategoryRequest $request)
    {
        $pageLimit = $request->input('pageLimit');

        if ($request->wantsJson()) {
            $categories = $this->repository
                ->setPresenter('\\Litepie\\Block\\Repositories\\Presenter\\CategoryListPresenter')
                ->scopeQuery(function ($query) {
                    return $query->orderBy('id', 'DESC');
                })->paginate($pageLimit);

            $categories['recordsTotal'] = $categories['meta']['pagination']['total'];
            $categories['recordsFiltered'] = $categories['meta']['pagination']['total'];
            $categories['request'] = $request->all();
            return response()->json($categories, 200);

        }

        $this->theme->prependTitle(trans('block::category.names') . ' :: ');
        return $this->theme->of('block::admin.category.index')->render();
    }

    /**
     * Display category.
     *
     * @param Request $request
     * @param Model   $category
     *
     * @return Response
     */
    public function show(CategoryRequest $request, Category $category)
    {

        if (!$category->exists) {
            return response()->view('block::admin.category.new', compact('category'));
        }

        Form::populate($category);
        return response()->view('block::admin.category.show', compact('category'));
    }

    /**
     * Show the form for creating a new category.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function create(CategoryRequest $request)
    {

        $category = $this->repository->newInstance([]);

        Form::populate($category);

        return response()->view('block::admin.category.create', compact('category'));

    }

    /**
     * Create new category.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(CategoryRequest $request)
    {
        try {
            $attributes = $request->all();
            $attributes['user_id'] = user_id('admin.web');
            $attributes['user_type'] = user_type();
            $category = $this->repository->create($attributes);

            return response()->json([
                'message'  => trans('messages.success.updated', ['Module' => trans('block::category.name')]),
                'code'     => 204,
                'redirect' => trans_url('/admin/block/category/' . $category->getRouteKey()),
            ], 201);

        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'code'    => 400,
            ], 400);
        }

    }

    /**
     * Show category for editing.
     *
     * @param Request $request
     * @param Model   $category
     *
     * @return Response
     */
    public function edit(CategoryRequest $request, Category $category)
    {
        Form::populate($category);
        return response()->view('block::admin.category.edit', compact('category'));
    }

    /**
     * Update the category.
     *
     * @param Request $request
     * @param Model   $category
     *
     * @return Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        try {

            $attributes = $request->all();

            $category->update($attributes);

            return response()->json([
                'message'  => trans('messages.success.updated', ['Module' => trans('block::category.name')]),
                'code'     => 204,
                'redirect' => trans_url('/admin/block/category/' . $category->getRouteKey()),
            ], 201);

        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 400,
                'redirect' => trans_url('/admin/block/category/' . $category->getRouteKey()),
            ], 400);

        }

    }

    /**
     * Remove the category.
     *
     * @param Model   $category
     *
     * @return Response
     */
    public function destroy(CategoryRequest $request, Category $category)
    {

        try {

            $t = $category->delete();

            return response()->json([
                'message'  => trans('messages.success.deleted', ['Module' => trans('block::category.name')]),
                'code'     => 202,
                'redirect' => trans_url('/admin/block/category/0'),
            ], 202);

        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 400,
                'redirect' => trans_url('/admin/block/category/' . $category->getRouteKey()),
            ], 400);
        }

    }

}
