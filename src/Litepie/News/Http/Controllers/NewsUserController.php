<?php

namespace Litepie\News\Http\Controllers;

use App\Http\Controllers\UserController as BaseController;
use Form;
use Litepie\News\Http\Requests\NewsRequest;
use Litepie\News\Interfaces\NewsRepositoryInterface;
use Litepie\News\Models\News;

class NewsUserController extends BaseController
{
    /**
     * Initialize news controller.
     *
     * @param type NewsRepositoryInterface $news
     *
     * @return type
     */
    public function __construct(NewsRepositoryInterface $news)
    {
        $this->repository = $news;
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(NewsRequest $request)
    {
        $guard = $this->getGuardRoute();
        
        $this->repository
                ->pushCriteria(app('Litepie\Repository\Criteria\RequestCriteria'))
                ->pushCriteria(new \Litepie\News\Repositories\Criteria\NewsUserCriteria());
        $news = $this->repository->scopeQuery(function($query){
            return $query->orderBy('id','DESC');
        })->paginate(3);

        $this->theme->prependTitle(trans('news::news.names'));

        return $this->theme->of('news::user.news.index', compact('news','guard'))->render();
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param News $news
     *
     * @return Response
     */
    public function show(NewsRequest $request, News $news)
    {
        Form::populate($news);
        $guard = $this->getGuardRoute();
        $this->theme->prependTitle(trans('news::news.names'));

        return $this->theme->of('news::user.news.show', compact('news','guard'))->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function create(NewsRequest $request)
    {

        $news = $this->repository->newInstance([]);
        $guard = $this->getGuardRoute();
        Form::populate($news);
        
        $this->theme->prependTitle(trans('news::news.names'));
        return $this->theme->of('news::user.news.create', compact('news','guard'))->render();
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(NewsRequest $request)
    {
        try {
            $attributes = $request->all();
            $attributes['user_id'] = user_id();
            $attributes['user_type'] = user_type();
            $news = $this->repository->create($attributes);

            return redirect(trans_url('/user/news/news'))
                -> with('message', trans('messages.success.created', ['Module' => trans('news::news.name')]))
                -> with('code', 201);

        } catch (Exception $e) {
            redirect()->back()->withInput()->with('message', $e->getMessage())->with('code', 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param News $news
     *
     * @return Response
     */
    public function edit(NewsRequest $request, News $news)
    {

        Form::populate($news);
        $guard = $this->getGuardRoute();

        $this->theme->prependTitle(trans('news::news.names'));
        return $this->theme->of('news::user.news.edit', compact('news','guard'))->render();
    }

    /**
     * Update the specified resource.
     *
     * @param Request $request
     * @param News $news
     *
     * @return Response
     */
    public function update(NewsRequest $request, News $news)
    {
        try {
            $this->repository->update($request->all(), $news->getRouteKey());

            return redirect(trans_url('/user/news/news'))
                ->with('message', trans('messages.success.updated', ['Module' => trans('news::news.name')]))
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
    public function destroy(NewsRequest $request, News $news)
    {
        try {
            $this->repository->delete($news->getRouteKey());
            return response()->json([
                'message'  => trans('messages.success.deleted', ['Module' => trans('news::news.name')]),
                'code'     => 202,
                'redirect' => trans_url('/user/news/news'),
            ], 202);
        } catch (Exception $e) {

            redirect()->back()->withInput()->with('message', $e->getMessage())->with('code', 400);

        }
    }
}
