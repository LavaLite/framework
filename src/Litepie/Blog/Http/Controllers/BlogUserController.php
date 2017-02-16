<?php

namespace Litepie\Blog\Http\Controllers;

use App\Http\Controllers\UserController as BaseController;
use Form;
use Litepie\Blog\Http\Requests\BlogRequest;
use Litepie\Blog\Interfaces\BlogRepositoryInterface;
use Litepie\Blog\Models\Blog;

class BlogUserController extends BaseController
{
    /**
     * Initialize blog controller.
     *
     * @param type BlogRepositoryInterface $blog
     *
     * @return type
     */
    public function __construct(BlogRepositoryInterface $blog)
    {
        $this->repository = $blog;
        $this->repository
                ->pushCriteria(app('Litepie\Repository\Criteria\RequestCriteria'))
                ->pushCriteria(new \Litepie\Blog\Repositories\Criteria\BlogUserCriteria());
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(BlogRequest $request)
    {
        $blogs = $this->repository->scopeQuery(function($query){
            return $query->orderBy('id','DESC');
        })->paginate();

        $this->theme->prependTitle(trans('blog::blog.names'));

        return $this->theme->of('blog::user.blog.index', compact('blogs'))->render();
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Blog $blog
     *
     * @return Response
     */
    public function show(BlogRequest $request, Blog $blog)
    {
        Form::populate($blog);

        return $this->theme->of('blog::user.blog.show', compact('blog'))->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function create(BlogRequest $request)
    {

        $blog = $this->repository->newInstance([]);
        Form::populate($blog);

        $this->theme->prependTitle(trans('blog::blog.names'));
        return $this->theme->of('blog::user.blog.create', compact('blog'))->render();
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(BlogRequest $request)
    {
        try {
            $attributes = $request->all();
            $attributes['user_id'] = user_id();
            $blog = $this->repository->create($attributes);

            return redirect(trans_url('/user/blog/blog'))
                -> with('message', trans('messages.success.created', ['Module' => trans('blog::blog.name')]))
                -> with('code', 201);

        } catch (Exception $e) {
            redirect()->back()->withInput()->with('message', $e->getMessage())->with('code', 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param Blog $blog
     *
     * @return Response
     */
    public function edit(BlogRequest $request, Blog $blog)
    {

        Form::populate($blog);
        $this->theme->prependTitle(trans('blog::blog.names'));

        return $this->theme->of('blog::user.blog.edit', compact('blog'))->render();
    }

    /**
     * Update the specified resource.
     *
     * @param Request $request
     * @param Blog $blog
     *
     * @return Response
     */
    public function update(BlogRequest $request, Blog $blog)
    {
        try {
            $this->repository->update($request->all(), $blog->getRouteKey());

            return redirect(trans_url('/user/blog/blog'))
                ->with('message', trans('messages.success.updated', ['Module' => trans('blog::blog.name')]))
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
    public function destroy(BlogRequest $request, Blog $blog)
    {
        try {
            $this->repository->delete($blog->getRouteKey());
            return redirect(trans_url('/user/blog/blog'))
                ->with('message', trans('messages.success.deleted', ['Module' => trans('blog::blog.name')]))
                ->with('code', 204);

        } catch (Exception $e) {

            redirect()->back()->withInput()->with('message', $e->getMessage())->with('code', 400);

        }
    }
}
