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
     * Initialize blog_category controller.
     *
     * @param type BlogCategoryRepositoryInterface $blog_category
     *
     * @return type
     */
    public function __construct(BlogCategoryRepositoryInterface $blog_category)
    {
        $this->repository = $blog_category;
        parent::__construct();
    }

    /**
     * Display a list of blog_category.
     *
     * @return Response
     */
    public function index(BlogCategoryRequest $request)
    {
        if ($request->wantsJson()) {
            return $this->getJson($request);
        }
        $this   ->theme->prependTitle(trans('blog::blog_category.names').' :: ');
        return $this->theme->of('blog::admin.blog_category.index')->render();
    }

    /**
     * Display a list of blog_category.
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
     * Display blog_category.
     *
     * @param Request $request
     * @param Model   $blog_category
     *
     * @return Response
     */
    public function show(BlogCategoryRequest $request, BlogCategory $blog_category)
    {
        if (!$blog_category->exists) {
            return response()->view('blog::admin.blog_category.new', compact('blog_category'));
        }

        Form::populate($blog_category);
        return response()->view('blog::admin.blog_category.show', compact('blog_category'));
    }

    /**
     * Show the form for creating a new blog_category.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function create(BlogCategoryRequest $request)
    {

        $blog_category = $this->repository->newInstance([]);

        Form::populate($blog_category);

        return response()->view('blog::admin.blog_category.create', compact('blog_category'));

    }

    /**
     * Create new blog_category.
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
            $blog_category          = $this->repository->create($attributes);

            return response()->json([
                'message'  => trans('messages.success.updated', ['Module' => trans('blog::blog_category.name')]),
                'code'     => 204,
                'redirect' => trans_url('/admin/blog/blog_category/'.$blog_category->getRouteKey())
            ], 201);


        } catch (Exception $e) {
            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 400,
            ], 400);
        }
    }

    /**
     * Show blog_category for editing.
     *
     * @param Request $request
     * @param Model   $blog_category
     *
     * @return Response
     */
    public function edit(BlogCategoryRequest $request, BlogCategory $blog_category)
    {
        Form::populate($blog_category);
        return  response()->view('blog::admin.blog_category.edit', compact('blog_category'));
    }

    /**
     * Update the blog_category.
     *
     * @param Request $request
     * @param Model   $blog_category
     *
     * @return Response
     */
    public function update(BlogCategoryRequest $request, BlogCategory $blog_category)
    {
        try {

            $attributes = $request->all();

            $blog_category->update($attributes);

            return response()->json([
                'message'  => trans('messages.success.updated', ['Module' => trans('blog::blog_category.name')]),
                'code'     => 204,
                'redirect' => trans_url('/admin/blog/blog_category/'.$blog_category->getRouteKey())
            ], 201);

        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 400,
                'redirect' => trans_url('/admin/blog/blog_category/'.$blog_category->getRouteKey()),
            ], 400);

        }
    }

    /**
     * Remove the blog_category.
     *
     * @param Model   $blog_category
     *
     * @return Response
     */
    public function destroy(BlogCategoryRequest $request, BlogCategory $blog_category)
    {

        try {

            $t = $blog_category->delete();

            return response()->json([
                'message'  => trans('messages.success.deleted', ['Module' => trans('blog::blog_category.name')]),
                'code'     => 202,
                'redirect' => trans_url('/admin/blog/blog_category/0'),
            ], 202);

        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 400,
                'redirect' => trans_url('/admin/blog/blog_category/'.$blog_category->getRouteKey()),
            ], 400);
        }
    }

}
