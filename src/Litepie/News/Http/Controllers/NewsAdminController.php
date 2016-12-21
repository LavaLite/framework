<?php

namespace Litepie\News\Http\Controllers;

use App\Http\Controllers\AdminController as BaseController;
use Form;
use Litepie\News\Http\Requests\NewsRequest;
use Litepie\News\Interfaces\NewsRepositoryInterface;
use Litepie\News\Models\News;

/**
 * Admin web controller class.
 */
class NewsAdminController extends BaseController
{
    use NewsWorkflow;
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
     * Display a list of news.
     *
     * @return Response
     */
    public function index(NewsRequest $request)
    {
        if ($request->wantsJson()) {
            return $this->getJson($request);
        }
        $this   ->theme->prependTitle(trans('news::news.names').' :: ');
        return $this->theme->of('news::admin.news.index')->render();
    }

    /**
     * Display a list of news.
     *
     * @return Response
     */
    public function getJson(NewsRequest $request)
    {
        $pageLimit = $request->input('pageLimit');

        $news  = $this->repository
                ->pushCriteria(app('Litepie\Repository\Criteria\RequestCriteria'))
                ->setPresenter('\\Litepie\\News\\Repositories\\Presenter\\NewsListPresenter')
                ->scopeQuery(function($query){
                    return $query->orderBy('id','DESC');
                })->paginate($pageLimit);
        $news['recordsTotal']    = $news['meta']['pagination']['total'];
        $news['recordsFiltered'] = $news['meta']['pagination']['total'];
        $news['request']         = $request->all();
        return response()->json($news, 200);

    }

    /**
     * Display news.
     *
     * @param Request $request
     * @param Model   $news
     *
     * @return Response
     */
    public function show(NewsRequest $request, News $news)
    {
        if (!$news->exists) {
            return response()->view('news::admin.news.new', compact('news'));
        }

        Form::populate($news);
        return response()->view('news::admin.news.show', compact('news'));
    }

    /**
     * Show the form for creating a new news.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function create(NewsRequest $request)
    {

        $news = $this->repository->newInstance([]);

        Form::populate($news);

        return response()->view('news::admin.news.create', compact('news'));

    }

    /**
     * Create new news.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(NewsRequest $request)
    {
        try {
            $attributes             = $request->all();
            $attributes['user_id']  = user_id('admin.web');
            $news          = $this->repository->create($attributes);

            return response()->json([
                'message'  => trans('messages.success.updated', ['Module' => trans('news::news.name')]),
                'code'     => 204,
                'redirect' => trans_url('/admin/news/news/'.$news->getRouteKey())
            ], 201);


        } catch (Exception $e) {
            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 400,
            ], 400);
        }
    }

    /**
     * Show news for editing.
     *
     * @param Request $request
     * @param Model   $news
     *
     * @return Response
     */
    public function edit(NewsRequest $request, News $news)
    {
        Form::populate($news);
        return  response()->view('news::admin.news.edit', compact('news'));
    }

    /**
     * Update the news.
     *
     * @param Request $request
     * @param Model   $news
     *
     * @return Response
     */
    public function update(NewsRequest $request, News $news)
    {
        try {

            $attributes = $request->all();

            $news->update($attributes);

            return response()->json([
                'message'  => trans('messages.success.updated', ['Module' => trans('news::news.name')]),
                'code'     => 204,
                'redirect' => trans_url('/admin/news/news/'.$news->getRouteKey())
            ], 201);

        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 400,
                'redirect' => trans_url('/admin/news/news/'.$news->getRouteKey()),
            ], 400);

        }
    }

    /**
     * Remove the news.
     *
     * @param Model   $news
     *
     * @return Response
     */
    public function destroy(NewsRequest $request, News $news)
    {

        try {

            $t = $news->delete();

            return response()->json([
                'message'  => trans('messages.success.deleted', ['Module' => trans('news::news.name')]),
                'code'     => 202,
                'data'     => $news,
                'redirect' => trans_url('/admin/news/news'),
            ], 202);

           /* return redirect(trans_url('/user/testimonial/testimonial'))
                ->with('message', trans('messages.success.deleted', ['Module' => trans('testimonial::testimonial.name')]))
                ->with('code', 204);*/

        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 400,
                'redirect' => trans_url('/admin/news/news/'.$news->getRouteKey()),
            ], 400);
        }
    }
}