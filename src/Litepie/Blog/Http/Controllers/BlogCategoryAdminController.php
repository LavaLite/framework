<?php

namespace Litepie\Blog\Http\Controllers;

use App\Http\Controllers\AdminController as BaseController;
use Form;
use Litepie\Blog\Http\Requests\BlogCategoryRequest;
use Litepie\Blog\Interfaces\BlogCategoryRepositoryInterface;
use Litepie\Blog\Models\BlogCategory;

/**
 * Admin web controller class.
 */
class BlogCategoryAdminController extends BaseController
{
    // use BlogCategoryWorkflow;
    /**
     * Initialize category controller.
     *
     * @param type BlogCategoryRepositoryInterface $category
     *
     * @return type
     */
    public function __construct(BlogCategoryRepositoryInterface $category)
    {
        $this->repository = $category;
        parent::__construct();
    }

    /**
     * Display a list of category.
     *
     * @return Response
     */
    public function index(BlogCategoryRequest $request)
    {
        if ($request->wantsJson()) {
            return $this->getJson($request);
        }
        $this   ->theme->prependTitle(trans('blog::category.names').' :: ');
        return $this->theme->of('blog::admin.category.index')->render();
    }

    /**
     * Display a list of category.
     *
     * @return Response
     */
    public function getJson(BlogCategoryRequest $request)
    {
        $pageLimit = $request->input('pageLimit');

        $blog_categories  = $this->repository
                ->pushCriteria(app('Litepie\Repository\Criteria\RequestCriteria'))
                ->setPresenter('\\Litepie\\Blog\\Repositories\\Presenter\\BlogCategoryListPresenter')
                ->scopeQuery(function($query){
                    return $query->orderBy('id','DESC');
                })->paginate($pageLimit);
        $blog_categories['recordsTotal']    = $blog_categories['meta']['pagination']['total'];
        $blog_categories['recordsFiltered'] = $blog_categories['meta']['pagination']['total'];
        $blog_categories['request']         = $request->all();
        return response()->json($blog_categories, 200);

    }

    /**
     * Display category.
     *
     * @param Request $request
     * @param Model   $category
     *
     * @return Response
     */
    public function show(BlogCategoryRequest $request, BlogCategory $category)
    {
        if (!$category->exists) {
            return response()->view('blog::admin.category.new', compact('category'));
        }

        Form::populate($category);
        return response()->view('blog::admin.category.show', compact('category'));
    }

    /**
     * Show the form for creating a new category.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function create(BlogCategoryRequest $request)
    {

        $category = $this->repository->newInstance([]);

        Form::populate($category);

        return response()->view('blog::admin.category.create', compact('category'));

    }

    /**
     * Create new category.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(BlogCategoryRequest $request)
    {
        try {
            $attributes             = $request->all();
            $attributes['user_id']  = user_id('admin.web');
            $category          = $this->repository->create($attributes);

            return response()->json([
                'message'  => trans('messages.success.updated', ['Module' => trans('blog::category.name')]),
                'code'     => 204,
                'redirect' => trans_url('/admin/blog/category/'.$category->getRouteKey())
            ], 201);


        } catch (Exception $e) {
            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 400,
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
    public function edit(BlogCategoryRequest $request, BlogCategory $category)
    {
        Form::populate($category);
        return  response()->view('blog::admin.category.edit', compact('category'));
    }

    /**
     * Update the category.
     *
     * @param Request $request
     * @param Model   $category
     *
     * @return Response
     */
    public function update(BlogCategoryRequest $request, BlogCategory $category)
    {
        try {

            $attributes = $request->all();

            $category->update($attributes);

            return response()->json([
                'message'  => trans('messages.success.updated', ['Module' => trans('blog::category.name')]),
                'code'     => 204,
                'redirect' => trans_url('/admin/blog/category/'.$category->getRouteKey())
            ], 201);

        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 400,
                'redirect' => trans_url('/admin/blog/category/'.$category->getRouteKey()),
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
    public function destroy(BlogCategoryRequest $request, BlogCategory $category)
    {

        try {

            $t = $category->delete();

            return response()->json([
                'message'  => trans('messages.success.deleted', ['Module' => trans('blog::category.name')]),
                'code'     => 202,
                'redirect' => trans_url('/admin/blog/category/0'),
            ], 202);

        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 400,
                'redirect' => trans_url('/admin/blog/category/'.$category->getRouteKey()),
            ], 400);
        }
    }

}
