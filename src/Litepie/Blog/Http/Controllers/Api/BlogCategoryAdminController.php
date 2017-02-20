<?php

namespace Litepie\Blog\Http\Controllers\Api;

use App\Http\Controllers\Api\AdminController as BaseController;
use Litepie\Blog\Http\Requests\BlogCategoryRequest;
use Litepie\Blog\Interfaces\BlogCategoryRepositoryInterface;
use Litepie\Blog\Models\BlogCategory;

/**
 * Admin API controller class.
 */
class BlogCategoryAdminController extends BaseController
{
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
     * Display category.
     *
     * @param Request $request
     * @param Model   BlogCategory
     *
     * @return Json
     */
    public function show(BlogCategoryRequest $request, BlogCategory $category)
    {
        $category         = $category->presenter();
        $category['code'] = 2001;
        return response()->json($category)
                         ->setStatusCode(200, 'SHOW_SUCCESS');;

    }

    /**
     * Show the form for creating a new category.
     *
     * @param Request $request
     *
     * @return json
     */
    public function create(BlogCategoryRequest $request, BlogCategory $category)
    {
        $category         = $category->presenter();
        $category['code'] = 2002;
        return response()->json($category)
                         ->setStatusCode(200, 'CREATE_SUCCESS');

    }

    /**
     * Create new category.
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
            $category          = $this->repository->create($attributes);
            $category          = $category->presenter();
            $category['code']  = 2004;

            return response()->json($category)
                             ->setStatusCode(201, 'STORE_SUCCESS');
        } catch (Exception $e) {
            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 4004,
            ])->setStatusCode(400, 'STORE_ERROR');
        }
    }

    /**
     * Show category for editing.
     *
     * @param Request $request
     * @param Model   $category
     *
     * @return json
     */
    public function edit(BlogCategoryRequest $request, BlogCategory $category)
    {
        $category         = $category->presenter();
        $category['code'] = 2003;
        return response()-> json($category)
                        ->setStatusCode(200, 'EDIT_SUCCESS');;
    }

    /**
     * Update the category.
     *
     * @param Request $request
     * @param Model   $category
     *
     * @return json
     */
    public function update(BlogCategoryRequest $request, BlogCategory $category)
    {
        try {

            $attributes = $request->all();

            $category->update($attributes);
            $category         = $category->presenter();
            $category['code'] = 2005;

            return response()->json($category)
                             ->setStatusCode(201, 'UPDATE_SUCCESS');


        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 4005,
            ])->setStatusCode(400, 'UPDATE_ERROR');

        }
    }

    /**
     * Remove the category.
     *
     * @param Request $request
     * @param Model   $category
     *
     * @return json
     */
    public function destroy(BlogCategoryRequest $request, BlogCategory $category)
    {
        try {
            $t = $category->delete();

            return response()->json([
                'message'  => trans('messages.success.delete', ['Module' => trans('blog::category.name')]),
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
