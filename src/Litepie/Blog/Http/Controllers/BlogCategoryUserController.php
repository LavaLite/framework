<?php

namespace Litepie\Blog\Http\Controllers;

use App\Http\Controllers\UserController as BaseController;
use Form;
use Litepie\Blog\Http\Requests\BlogCategoryRequest;
use Litepie\Blog\Interfaces\BlogCategoryRepositoryInterface;
use Litepie\Blog\Models\BlogCategory;

class BlogCategoryUserController extends BaseController
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
        $this->repository
                ->pushCriteria(app('Litepie\Repository\Criteria\RequestCriteria'))
                ->pushCriteria(new \Litepie\Blog\Repositories\Criteria\BlogCategoryUserCriteria());
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(BlogCategoryRequest $request)
    {
        $blog_categories = $this->repository->scopeQuery(function($query){
            return $query->orderBy('id','DESC');
        })->paginate();

        $this->theme->prependTitle(trans('blog::category.names'));

        return $this->theme->of('blog::user.category.index', compact('blog_categories'))->render();
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param BlogCategory $category
     *
     * @return Response
     */
    public function show(BlogCategoryRequest $request, BlogCategory $category)
    {
        Form::populate($category);

        return $this->theme->of('blog::user.category.show', compact('category'))->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function create(BlogCategoryRequest $request)
    {

        $category = $this->repository->newInstance([]);
        Form::populate($category);

        $this->theme->prependTitle(trans('blog::category.names'));
        return $this->theme->of('blog::user.category.create', compact('category'))->render();
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(BlogCategoryRequest $request)
    {
        try {
            $attributes = $request->all();
            $attributes['user_id'] = user_id();
            $category = $this->repository->create($attributes);

            return redirect(trans_url('/user/blog/category'))
                -> with('message', trans('messages.success.created', ['Module' => trans('blog::category.name')]))
                -> with('code', 201);

        } catch (Exception $e) {
            redirect()->back()->withInput()->with('message', $e->getMessage())->with('code', 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param BlogCategory $category
     *
     * @return Response
     */
    public function edit(BlogCategoryRequest $request, BlogCategory $category)
    {

        Form::populate($category);
        $this->theme->prependTitle(trans('blog::category.names'));

        return $this->theme->of('blog::user.category.edit', compact('category'))->render();
    }

    /**
     * Update the specified resource.
     *
     * @param Request $request
     * @param BlogCategory $category
     *
     * @return Response
     */
    public function update(BlogCategoryRequest $request, BlogCategory $category)
    {
        try {
            $this->repository->update($request->all(), $category->getRouteKey());

            return redirect(trans_url('/user/blog/category'))
                ->with('message', trans('messages.success.updated', ['Module' => trans('blog::category.name')]))
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
    public function destroy(BlogCategoryRequest $request, BlogCategory $category)
    {
        try {
            $this->repository->delete($category->getRouteKey());
            return redirect(trans_url('/user/blog/category'))
                ->with('message', trans('messages.success.deleted', ['Module' => trans('blog::category.name')]))
                ->with('code', 204);

        } catch (Exception $e) {

            redirect()->back()->withInput()->with('message', $e->getMessage())->with('code', 400);

        }
    }
}
