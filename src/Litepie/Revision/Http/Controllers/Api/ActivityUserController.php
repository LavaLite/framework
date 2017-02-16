<?php

namespace Litepie\Revision\Http\Controllers\Api;

use App\Http\Controllers\Api\UserController as BaseController;
use Litepie\Revision\Http\Requests\RevisionRequest;
use Litepie\Revision\Interfaces\ActivityRepositoryInterface;
use Litepie\Revision\Models\Revision;

/**
 * User API controller class.
 */
class ActivityUserController extends BaseController
{
    /**
     * Initialize activity controller.
     *
     * @param type RevisionRepositoryInterface $activity
     *
     * @return type
     */
    public function __construct(ActivityRepositoryInterface $activity)
    {
        $this->repository = $activity;
        parent::__construct();
    }

    /**
     * Display a list of activity.
     *
     * @return json
     */
    public function index(RevisionRequest $request)
    {
        $activity  = $this->repository
            ->pushCriteria(new \Litepie\Revision\Repositories\Criteria\RevisionUserCriteria())
            ->setPresenter('\\Litepie\\Revision\\Repositories\\Presenter\\RevisionListPresenter')
            ->scopeQuery(function($query){
                return $query->orderBy('id','DESC');
            })->all();
        $activity['code'] = 2000;
        return response()->json($activity) 
            ->setStatusCode(200, 'INDEX_SUCCESS');

    }

    /**
     * Display activity.
     *
     * @param Request $request
     * @param Model   Revision
     *
     * @return Json
     */
    public function show(RevisionRequest $request, Revision $activity)
    {

        if ($activity->exists) {
            $activity         = $activity->presenter();
            $activity['code'] = 2001;
            return response()->json($activity)
                ->setStatusCode(200, 'SHOW_SUCCESS');;
        } else {
            return response()->json([])
                ->setStatusCode(400, 'SHOW_ERROR');
        }

    }

    /**
     * Show the form for creating a new activity.
     *
     * @param Request $request
     *
     * @return json
     */
    public function create(RevisionRequest $request, Revision $activity)
    {
        $activity         = $activity->presenter();
        $activity['code'] = 2002;
        return response()->json($activity)
            ->setStatusCode(200, 'CREATE_SUCCESS');
    }

    /**
     * Create new activity.
     *
     * @param Request $request
     *
     * @return json
     */
    public function store(RevisionRequest $request)
    {
        try {
            $attributes             = $request->all();
            $attributes['user_id']  = user_id('admin.api');
            $activity          = $this->repository->create($attributes);
            $activity          = $activity->presenter();
            $activity['code']  = 2004;

            return response()->json($activity)
                ->setStatusCode(201, 'STORE_SUCCESS');
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'code'    => 4004,
            ])->setStatusCode(400, 'STORE_ERROR');
        }

    }

    /**
     * Show activity for editing.
     *
     * @param Request $request
     * @param Model   $activity
     *
     * @return json
     */
    public function edit(RevisionRequest $request, Revision $activity)
    {
        if ($activity->exists) {
            $activity         = $activity->presenter();
            $activity['code'] = 2003;
            return response()-> json($activity)
                ->setStatusCode(200, 'EDIT_SUCCESS');;
        } else {
            return response()->json([])
                ->setStatusCode(400, 'SHOW_ERROR');
        }
    }

    /**
     * Update the activity.
     *
     * @param Request $request
     * @param Model   $activity
     *
     * @return json
     */
    public function update(RevisionRequest $request, Revision $activity)
    {
        try {

            $attributes = $request->all();

            $activity->update($attributes);
            $activity         = $activity->presenter();
            $activity['code'] = 2005;

            return response()->json($activity)
                ->setStatusCode(201, 'UPDATE_SUCCESS');


        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 4005,
            ])->setStatusCode(400, 'UPDATE_ERROR');

        }
    }

    /**
     * Remove the activity.
     *
     * @param Request $request
     * @param Model   $activity
     *
     * @return json
     */
    public function destroy(RevisionRequest $request, Revision $activity)
    {

        try {

            $t = $activity->delete();

            return response()->json([
                'message'  => trans('messages.success.delete', ['Module' => trans('activity::activity.name')]),
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