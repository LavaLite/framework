<?php

namespace Litepie\Revision\Http\Controllers;

use App\Http\Controllers\AdminController as BaseController;
use Form;
use Litepie\Revision\Http\Requests\RevisionRequest;
use Litepie\Revision\Interfaces\ActivityRepositoryInterface;
use Litepie\Revision\Models\Activity;

/**
 * Admin web controller class.
 */
class ActivityAdminController extends BaseController
{
    /**
     * Initialize revision controller.
     *
     * @param type ActivityRepositoryInterface $activity
     *
     * @return type
     */
    public function __construct(ActivityRepositoryInterface $activity)
    {
        $this->repository = $activity;
        parent::__construct();
    }

    /**
     * Display a list of revision.
     *
     * @return Response
     */
    public function index(RevisionRequest $request)
    {
        if ($request->wantsJson()) {
            return $this->getJson($request);
        }
        $this   ->theme->prependTitle(trans('revision::activity.names').' :: ');
        return $this->theme->of('revision::admin.activity.index')->render();
    }

    /**
     * Display a list of revision.
     *
     * @return Response
     */
    public function getJson(RevisionRequest $request)
    {
        $pageLimit = $request->input('pageLimit');

        $activity  = $this->repository
                ->pushCriteria(app('Litepie\Repository\Criteria\RequestCriteria'))
                ->setPresenter('\\Litepie\\Revision\\Repositories\\Presenter\\ActivityListPresenter')
                ->scopeQuery(function($query){
                    return $query->orderBy('id','DESC');
                })->paginate($pageLimit);
        $activity['recordsTotal']    = $activity['meta']['pagination']['total'];
        $activity['recordsFiltered'] = $activity['meta']['pagination']['total'];
        $activity['request']         = $request->all();
        return response()->json($activity, 200);

    }

    /**
     * Display revision.
     *
     * @param Request $request
     * @param Model   $activity
     *
     * @return Response
     */
    public function show(RevisionRequest $request, Revision $activity)
    {
        if (!$activity->exists) {
            return response()->view('revision::admin.activity.new', compact('revision'));
        }

        Form::populate($activity);
        return response()->view('revision::admin.activity.show', compact('revision'));
    }

    /**
     * Show the form for creating a new revision.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function create(RevisionRequest $request)
    {

        $activity = $this->repository->newInstance([]);

        Form::populate($activity);

        return response()->view('revision::admin.activity.create', compact('revision'));

    }

    /**
     * Create new revision.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(RevisionRequest $request)
    {
        try {
            $attributes             = $request->all();
            $attributes['user_id']  = user_id('admin.web');
            $activity          = $this->repository->create($attributes);

            return response()->json([
                'message'  => trans('messages.success.updated', ['Module' => trans('revision::activity.name')]),
                'code'     => 204,
                'redirect' => trans_url('/admin/revision/activity/'.$activity->getRouteKey())
            ], 201);


        } catch (Exception $e) {
            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 400,
            ], 400);
        }
    }

    /**
     * Show revision for editing.
     *
     * @param Request $request
     * @param Model   $activity
     *
     * @return Response
     */
    public function edit(RevisionRequest $request, Revision $activity)
    {
        Form::populate($activity);
        return  response()->view('revision::admin.activity.edit', compact('revision'));
    }

    /**
     * Update the revision.
     *
     * @param Request $request
     * @param Model   $activity
     *
     * @return Response
     */
    public function update(RevisionRequest $request, Revision $activity)
    {
        try {

            $attributes = $request->all();

            $activity->update($attributes);

            return response()->json([
                'message'  => trans('messages.success.updated', ['Module' => trans('revision::activity.name')]),
                'code'     => 204,
                'redirect' => trans_url('/admin/revision/activity/'.$activity->getRouteKey())
            ], 201);

        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 400,
                'redirect' => trans_url('/admin/revision/activity/'.$activity->getRouteKey()),
            ], 400);

        }
    }

    /**
     * Remove the revision.
     *
     * @param Model   $activity
     *
     * @return Response
     */
    public function destroy(RevisionRequest $request, Revision $activity)
    {

        try {

            $t = $activity->delete();

            return response()->json([
                'message'  => trans('messages.success.deleted', ['Module' => trans('revision::activity.name')]),
                'code'     => 202,
                'data'     => $activity,
                'redirect' => trans_url('/admin/revision/activity'),
            ], 202);

           /* return redirect(trans_url('/user/testimonial/testimonial'))
                ->with('message', trans('messages.success.deleted', ['Module' => trans('testimonial::testimonial.name')]))
                ->with('code', 204);*/

        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 400,
                'redirect' => trans_url('/admin/revision/activity/'.$activity->getRouteKey()),
            ], 400);
        }
    }
}