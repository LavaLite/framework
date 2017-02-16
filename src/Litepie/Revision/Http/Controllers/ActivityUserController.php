<?php

namespace Litepie\Revision\Http\Controllers;

use App\Http\Controllers\UserController as BaseController;
use Form;
use Litepie\Revision\Http\Requests\RevisionRequest;
use Litepie\Revision\Interfaces\ActivityRepositoryInterface;
use Litepie\Revision\Models\Activity;

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
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(RevisionRequest $request)
    {
        $guard = $this->getGuardRoute();
        
        $this->repository
                ->pushCriteria(app('Litepie\Repository\Criteria\RequestCriteria'))
                ->pushCriteria(new \Litepie\Revision\Repositories\Criteria\RevisionUserCriteria());
        $activity = $this->repository->scopeQuery(function($query){
            return $query->orderBy('id','DESC');
        })->paginate();

        $this->theme->prependTitle(trans('revision::activity.names'));

        return $this->theme->of('revision::user.activity.index', compact('activity','guard'))->render();
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Revision $activity
     *
     * @return Response
     */
    public function show(RevisionRequest $request, Revision $activity)
    {
        Form::populate($activity);
        $guard = $this->getGuardRoute();
        $this->theme->prependTitle(trans('revision::activity.names'));

        return $this->theme->of('revision::user.activity.show', compact('activity','guard'))->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function create(RevisionRequest $request)
    {

        $activity = $this->repository->newInstance([]);
        $guard = $this->getGuardRoute();
        Form::populate($activity);
        
        $this->theme->prependTitle(trans('revision::activity.names'));
        return $this->theme->of('revision::user.activity.create', compact('activity','guard'))->render();
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(RevisionRequest $request)
    {
        try {
            $attributes = $request->all();
            $attributes['user_id'] = user_id();
            $attributes['user_type'] = user_type();
            $activity = $this->repository->create($attributes);

            return redirect(trans_url('/user/activity/activity'))
                -> with('message', trans('messages.success.created', ['Module' => trans('revision::activity.name')]))
                -> with('code', 201);

        } catch (Exception $e) {
            redirect()->back()->withInput()->with('message', $e->getMessage())->with('code', 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param Revision $activity
     *
     * @return Response
     */
    public function edit(RevisionRequest $request, Revision $activity)
    {

        Form::populate($activity);
        $guard = $this->getGuardRoute();

        $this->theme->prependTitle(trans('revision::activity.names'));
        return $this->theme->of('revision::user.activity.edit', compact('activity','guard'))->render();
    }

    /**
     * Update the specified resource.
     *
     * @param Request $request
     * @param Revision $activity
     *
     * @return Response
     */
    public function update(RevisionRequest $request, Revision $activity)
    {
        try {
            $this->repository->update($request->all(), $activity->getRouteKey());

            return redirect(trans_url('/user/activity/activity'))
                ->with('message', trans('messages.success.updated', ['Module' => trans('revision::activity.name')]))
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
    public function destroy(RevisionRequest $request, Revision $activity)
    {
        try {
            $this->repository->delete($activity->getRouteKey());
            return response()->json([
                'message'  => trans('messages.success.deleted', ['Module' => trans('revision::activity.name')]),
                'code'     => 202,
                'redirect' => trans_url('/user/activity/activity'),
            ], 202);
        } catch (Exception $e) {

            redirect()->back()->withInput()->with('message', $e->getMessage())->with('code', 400);

        }
    }
}
