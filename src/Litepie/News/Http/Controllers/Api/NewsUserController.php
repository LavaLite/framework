<?php

namespace Litepie\News\Http\Controllers\Api;

use App\Http\Controllers\Api\UserController as BaseController;
use Litepie\News\Http\Requests\NewsRequest;
use Litepie\News\Interfaces\NewsRepositoryInterface;
use Litepie\News\Models\News;

/**
 * User API controller class.
 */
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
     * Display a list of news.
     *
     * @return json
     */
    public function index(NewsRequest $request)
    {
        $news  = $this->repository
            ->pushCriteria(new \Litepie\News\Repositories\Criteria\NewsUserCriteria())
            ->setPresenter('\\Litepie\\News\\Repositories\\Presenter\\NewsListPresenter')
            ->scopeQuery(function($query){
                return $query->orderBy('id','DESC');
            })->all();
        $news['code'] = 2000;
        return response()->json($news) 
            ->setStatusCode(200, 'INDEX_SUCCESS');

    }

    /**
     * Display news.
     *
     * @param Request $request
     * @param Model   News
     *
     * @return Json
     */
    public function show(NewsRequest $request, News $news)
    {

        if ($news->exists) {
            $news         = $news->presenter();
            $news['code'] = 2001;
            return response()->json($news)
                ->setStatusCode(200, 'SHOW_SUCCESS');;
        } else {
            return response()->json([])
                ->setStatusCode(400, 'SHOW_ERROR');
        }

    }

    /**
     * Show the form for creating a new news.
     *
     * @param Request $request
     *
     * @return json
     */
    public function create(NewsRequest $request, News $news)
    {
        $news         = $news->presenter();
        $news['code'] = 2002;
        return response()->json($news)
            ->setStatusCode(200, 'CREATE_SUCCESS');
    }

    /**
     * Create new news.
     *
     * @param Request $request
     *
     * @return json
     */
    public function store(NewsRequest $request)
    {
        try {
            $attributes             = $request->all();
            $attributes['user_id']  = user_id('admin.api');
            $news          = $this->repository->create($attributes);
            $news          = $news->presenter();
            $news['code']  = 2004;

            return response()->json($news)
                ->setStatusCode(201, 'STORE_SUCCESS');
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'code'    => 4004,
            ])->setStatusCode(400, 'STORE_ERROR');
        }

    }

    /**
     * Show news for editing.
     *
     * @param Request $request
     * @param Model   $news
     *
     * @return json
     */
    public function edit(NewsRequest $request, News $news)
    {
        if ($news->exists) {
            $news         = $news->presenter();
            $news['code'] = 2003;
            return response()-> json($news)
                ->setStatusCode(200, 'EDIT_SUCCESS');;
        } else {
            return response()->json([])
                ->setStatusCode(400, 'SHOW_ERROR');
        }
    }

    /**
     * Update the news.
     *
     * @param Request $request
     * @param Model   $news
     *
     * @return json
     */
    public function update(NewsRequest $request, News $news)
    {
        try {

            $attributes = $request->all();

            $news->update($attributes);
            $news         = $news->presenter();
            $news['code'] = 2005;

            return response()->json($news)
                ->setStatusCode(201, 'UPDATE_SUCCESS');


        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 4005,
            ])->setStatusCode(400, 'UPDATE_ERROR');

        }
    }

    /**
     * Remove the news.
     *
     * @param Request $request
     * @param Model   $news
     *
     * @return json
     */
    public function destroy(NewsRequest $request, News $news)
    {

        try {

            $t = $news->delete();

            return response()->json([
                'message'  => trans('messages.success.delete', ['Module' => trans('news::news.name')]),
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