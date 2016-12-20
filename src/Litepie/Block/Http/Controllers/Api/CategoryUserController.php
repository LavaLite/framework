<?php

namespace Litepie\Block\Http\Controller\Api;

use App\Http\Controllers\Controller as BaseController;
use Litepie\Block\Http\Requests\CategoryUserApiRequest;
use Litepie\Block\Interfaces\CategoryRepositoryInterface;
use Litepie\Block\Models\Category;

/**
 * User API controller class.
 */
class CategoryUserController extends BaseController
{

    /**
     * The authentication guard that should be used.
     *
     * @var string
     */
    protected $guard = 'api';

    /**
     * Initialize category controller.
     *
     * @param type CategoryRepositoryInterface $category
     *
     * @return type
     */
    public function __construct(CategoryRepositoryInterface $category)
    {
        $this->middleware('api');
        $this->middleware('jwt.auth:api');
        $this->setupTheme(config('theme.themes.user.theme'), config('theme.themes.user.layout'));
        $this->repository = $category;
        parent::__construct();
    }

    /**
     * Display a list of category.
     *
     * @return json
     */
    public function index(CategoryUserApiRequest $request)
    {
        $categories = $this->repository
            ->pushCriteria(new \Litepie\Block\Repositories\Criteria\CategoryUserCriteria())
            ->setPresenter('\\Litepie\\Block\\Repositories\\Presenter\\CategoryListPresenter')
            ->scopeQuery(function ($query) {
                return $query->orderBy('id', 'DESC');
            })->all();
        $categories['code'] = 2000;
        return response()->json($categories)
            ->setStatusCode(200, 'INDEX_SUCCESS');

    }

    /**
     * Display category.
     *
     * @param Request $request
     * @param Model   Category
     *
     * @return Json
     */
    public function show(CategoryUserApiRequest $request, Category $category)
    {

        if ($category->exists) {
            $category = $category->presenter();
            $category['code'] = 2001;
            return response()->json($category)
                ->setStatusCode(200, 'SHOW_SUCCESS');
        } else {
            return response()->json([])
                ->setStatusCode(400, 'SHOW_ERROR');
        }

    }

    /**
     * Show the form for creating a new category.
     *
     * @param Request $request
     *
     * @return json
     */
    public function create(CategoryUserApiRequest $request, Category $category)
    {
        $category = $category->presenter();
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
    public function store(CategoryUserApiRequest $request)
    {
        try {
            $attributes = $request->all();
            $attributes['user_id'] = user_id('admin.api');
            $attributes['user_type'] = user_type();
            $category = $this->repository->create($attributes);
            $category = $category->presenter();
            $category['code'] = 2004;

            return response()->json($category)
                ->setStatusCode(201, 'STORE_SUCCESS');
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'code'    => 4004,
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
    public function edit(CategoryUserApiRequest $request, Category $category)
    {

        if ($category->exists) {
            $category = $category->presenter();
            $category['code'] = 2003;
            return response()->json($category)
                ->setStatusCode(200, 'EDIT_SUCCESS');
        } else {
            return response()->json([])
                ->setStatusCode(400, 'SHOW_ERROR');
        }

    }

    /**
     * Update the category.
     *
     * @param Request $request
     * @param Model   $category
     *
     * @return json
     */
    public function update(CategoryUserApiRequest $request, Category $category)
    {
        try {

            $attributes = $request->all();

            $category->update($attributes);
            $category = $category->presenter();
            $category['code'] = 2005;

            return response()->json($category)
                ->setStatusCode(201, 'UPDATE_SUCCESS');

        } catch (Exception $e) {

            return response()->json([
                'message' => $e->getMessage(),
                'code'    => 4005,
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
    public function destroy(CategoryUserApiRequest $request, Category $category)
    {

        try {

            $t = $category->delete();

            return response()->json([
                'message' => trans('messages.success.delete', ['Module' => trans('block::category.name')]),
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
