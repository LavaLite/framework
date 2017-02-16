<?php

namespace Litepie\Revision\Http\Controllers;

use App\Http\Controllers\UserController as BaseController;
use Form;
use Litepie\Revision\Http\Requests\RevisionRequest;
use Litepie\Revision\Interfaces\RevisionRepositoryInterface;
use Litepie\Revision\Models\Revision;

class RevisionUserController extends BaseController
{
    /**
     * Initialize revision controller.
     *
     * @param type RevisionRepositoryInterface $revision
     *
     * @return type
     */
    public function __construct(RevisionRepositoryInterface $revision)
    {
        $this->repository = $revision;
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
        $revision = $this->repository->scopeQuery(function($query){
            return $query->orderBy('id','DESC');
        })->paginate();

        $this->theme->prependTitle(trans('revision::revision.names'));

        return $this->theme->of('revision::user.revision.index', compact('revision','guard'))->render();
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Revision $revision
     *
     * @return Response
     */
    public function show(RevisionRequest $request, Revision $revision)
    {
        Form::populate($revision);
        $guard = $this->getGuardRoute();
        $this->theme->prependTitle(trans('revision::revision.names'));

        return $this->theme->of('revision::user.revision.show', compact('revision','guard'))->render();
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

        $revision = $this->repository->newInstance([]);
        $guard = $this->getGuardRoute();
        Form::populate($revision);
        
        $this->theme->prependTitle(trans('revision::revision.names'));
        return $this->theme->of('revision::user.revision.create', compact('revision','guard'))->render();
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
            $revision = $this->repository->create($attributes);

            return redirect(trans_url('/user/revision/revision'))
                -> with('message', trans('messages.success.created', ['Module' => trans('revision::revision.name')]))
                -> with('code', 201);

        } catch (Exception $e) {
            redirect()->back()->withInput()->with('message', $e->getMessage())->with('code', 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param Revision $revision
     *
     * @return Response
     */
    public function edit(RevisionRequest $request, Revision $revision)
    {

        Form::populate($revision);
        $guard = $this->getGuardRoute();

        $this->theme->prependTitle(trans('revision::revision.names'));
        return $this->theme->of('revision::user.revision.edit', compact('revision','guard'))->render();
    }

    /**
     * Update the specified resource.
     *
     * @param Request $request
     * @param Revision $revision
     *
     * @return Response
     */
    public function update(RevisionRequest $request, Revision $revision)
    {
        try {
            $this->repository->update($request->all(), $revision->getRouteKey());

            return redirect(trans_url('/user/revision/revision'))
                ->with('message', trans('messages.success.updated', ['Module' => trans('revision::revision.name')]))
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
    public function destroy(RevisionRequest $request, Revision $revision)
    {
        try {
            $this->repository->delete($revision->getRouteKey());
            return response()->json([
                'message'  => trans('messages.success.deleted', ['Module' => trans('revision::revision.name')]),
                'code'     => 202,
                'redirect' => trans_url('/user/revision/revision'),
            ], 202);
        } catch (Exception $e) {

            redirect()->back()->withInput()->with('message', $e->getMessage())->with('code', 400);

        }
    }
}
