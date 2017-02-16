<?php

namespace Litepie\Blog\Http\Controllers\Api;

use App\Http\Controllers\Api\UserController as BaseController;
use Litepie\Blog\Http\Requests\BlogCategoryRequest;
use Litepie\Blog\Interfaces\BlogCategoryRepositoryInterface;
use Litepie\Blog\Models\BlogCategory;

/**
 * User API controller class.
 */
class BlogCategoryUserController extends BaseController
{
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
        $this->repository
                ->pushCriteria(app('Litepie\Repository\Criteria\RequestCriteria'))
                ->pushCriteria(new \Litepie\Blog\Repositories\Criteria\BlogCategoryUserCriteria());
        parent::__construct();
    }

    /**
     * Display a list of blog_category.
     *
     * @return json
     */
    public function index(BlogCategoryRequest $request)
    {
        $blog_categories  = $this->repository
            ->setPresenter('\\Litepie\\Blog\\Repositories\\Presenter\\BlogCategoryListPresenter')
            ->scopeQuery(function($query){
                return $query->orderBy('id','DESC');
            })->all();
        $blog_categories['code'] = 2000;
        return response()->json($blog_categories) 
            ->setStatusCode(200, 'INDEX_SUCCESS');

    }

    /**
     * Display blog_category.
     *
     * @param Request $request
     * @param Model   BlogCategory
     *
     * @return Json
     */
    public function show(BlogCategoryRequest $request, BlogCategory $blog_category)
    {

        if ($blog_category->exists) {
            $blog_category         = $blog_category->presenter();
            $blog_category['code'] = 2001;
            return response()->json($blog_category)
                ->setStatusCode(200, 'SHOW_SUCCESS');;
        } else {
            return response()->json([])
                ->setStatusCode(400, 'SHOW_ERROR');
        }

    }

    /**
     * Show the form for creating a new blog_category.
     *
     * @param Request $request
     *
     * @return json
     */
    public function create(BlogCategoryRequest $request, BlogCategory $blog_category)
    {
        $blog_category         = $blog_category->presenter();
        $blog_category['code'] = 2002;
        return response()->json($blog_category)
            ->setStatusCode(200, 'CREATE_SUCCESS');
    }

    /**
     * Create new blog_category.
     *
     * @param Request $request
     *
     * @return json
     */
    public function store(BlogCategoryRequest $request)
    {
        try {
            $attributes             = $request->all();
            $attributes['user_id']  = user_id('admin.api');
            $blog_category          = $this->repository->create($attributes);
            $blog_category          = $blog_category->presenter();
            $blog_category['code']  = 2004;

            return response()->json($blog_category)
                ->setStatusCode(201, 'STORE_SUCCESS');
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'code'    => 4004,
            ])->setStatusCode(400, 'STORE_ERROR');
        }

    }

    /**
     * Show blog_category for editing.
     *
     * @param Request $request
     * @param Model   $blog_category
     *
     * @return json
     */
    public function edit(BlogCategoryRequest $request, BlogCategory $blog_category)
    {
        if ($blog_category->exists) {
            $blog_category         = $blog_category->presenter();
            $blog_category['code'] = 2003;
            return response()-> json($blog_category)
                ->setStatusCode(200, 'EDIT_SUCCESS');;
        } else {
            return response()->json([])
                ->setStatusCode(400, 'SHOW_ERROR');
        }
    }

    /**
     * Update the blog_category.
     *
     * @param Request $request
     * @param Model   $blog_category
     *
     * @return json
     */
    public function update(BlogCategoryRequest $request, BlogCategory $blog_category)
    {
        try {

            $attributes = $request->all();

            $blog_category->update($attributes);
            $blog_category         = $blog_category->presenter();
            $blog_category['code'] = 2005;

            return response()->json($blog_category)
                ->setStatusCode(201, 'UPDATE_SUCCESS');


        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 4005,
            ])->setStatusCode(400, 'UPDATE_ERROR');

        }
    }

    /**
     * Remove the blog_category.
     *
     * @param Request $request
     * @param Model   $blog_category
     *
     * @return json
     */
    public function destroy(BlogCategoryRequest $request, BlogCategory $blog_category)
    {

        try {

            $t = $blog_category->delete();

            return response()->json([
                'message'  => trans('messages.success.delete', ['Module' => trans('blog::blog_category.name')]),
                'code'     => 2006
            ])->setStatusCode(202, 'DESTROY_SUCCESS');

        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 4006,
            ])->setStatusCode(400, 'DESTROY_ERROR');
        }
    }
}
