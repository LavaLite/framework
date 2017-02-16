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
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(BlogCategoryRequest $request)
    {
        $blog_categories = $this->repository->scopeQuery(function($query){
            return $query->orderBy('id','DESC');
        })->paginate();

        $this->theme->prependTitle(trans('blog::blog_category.names'));

        return $this->theme->of('blog::user.blog_category.index', compact('blog_categories'))->render();
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param BlogCategory $blog_category
     *
     * @return Response
     */
    public function show(BlogCategoryRequest $request, BlogCategory $blog_category)
    {
        Form::populate($blog_category);

        return $this->theme->of('blog::user.blog_category.show', compact('blog_category'))->render();
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

        $blog_category = $this->repository->newInstance([]);
        Form::populate($blog_category);

        $this->theme->prependTitle(trans('blog::blog_category.names'));
        return $this->theme->of('blog::user.blog_category.create', compact('blog_category'))->render();
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
            $blog_category = $this->repository->create($attributes);

            return redirect(trans_url('/user/blog/blog_category'))
                -> with('message', trans('messages.success.created', ['Module' => trans('blog::blog_category.name')]))
                -> with('code', 201);

        } catch (Exception $e) {
            redirect()->back()->withInput()->with('message', $e->getMessage())->with('code', 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param BlogCategory $blog_category
     *
     * @return Response
     */
    public function edit(BlogCategoryRequest $request, BlogCategory $blog_category)
    {

        Form::populate($blog_category);
        $this->theme->prependTitle(trans('blog::blog_category.names'));

        return $this->theme->of('blog::user.blog_category.edit', compact('blog_category'))->render();
    }

    /**
     * Update the specified resource.
     *
     * @param Request $request
     * @param BlogCategory $blog_category
     *
     * @return Response
     */
    public function update(BlogCategoryRequest $request, BlogCategory $blog_category)
    {
        try {
            $this->repository->update($request->all(), $blog_category->getRouteKey());

            return redirect(trans_url('/user/blog/blog_category'))
                ->with('message', trans('messages.success.updated', ['Module' => trans('blog::blog_category.name')]))
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
    public function destroy(BlogCategoryRequest $request, BlogCategory $blog_category)
    {
        try {
            $this->repository->delete($blog_category->getRouteKey());
            return redirect(trans_url('/user/blog/blog_category'))
                ->with('message', trans('messages.success.deleted', ['Module' => trans('blog::blog_category.name')]))
                ->with('code', 204);

        } catch (Exception $e) {

            redirect()->back()->withInput()->with('message', $e->getMessage())->with('code', 400);

        }
    }
}
