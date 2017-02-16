<?php

namespace Litepie\Revision\Http\Controllers;

use App\Http\Controllers\AdminController as BaseController;
use Form;
use Litepie\Revision\Http\Requests\RevisionRequest;
use Litepie\Revision\Interfaces\RevisionRepositoryInterface;
use Litepie\Revision\Models\Revision;

/**
 * Admin web controller class.
 */
class RevisionAdminController extends BaseController
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
     * Display a list of revision.
     *
     * @return Response
     */
    public function index(RevisionRequest $request)
    {
        if ($request->wantsJson()) {
            return $this->getJson($request);
        }
        $this   ->theme->prependTitle(trans('revision::revision.names').' :: ');
        return $this->theme->of('revision::admin.revision.index')->render();
    }

    /**
     * Display a list of revision.
     *
     * @return Response
     */
    public function getJson(RevisionRequest $request)
    {
        $pageLimit = $request->input('pageLimit');

        $revision  = $this->repository
                ->pushCriteria(app('Litepie\Repository\Criteria\RequestCriteria'))
                ->setPresenter('\\Litepie\\Revision\\Repositories\\Presenter\\RevisionListPresenter')
                ->scopeQuery(function($query){
                    return $query->orderBy('id','DESC');
                })->paginate($pageLimit);
        $revision['recordsTotal']    = $revision['meta']['pagination']['total'];
        $revision['recordsFiltered'] = $revision['meta']['pagination']['total'];
        $revision['request']         = $request->all();
        return response()->json($revision, 200);

    }

    /**
     * Display revision.
     *
     * @param Request $request
     * @param Model   $revision
     *
     * @return Response
     */
    public function show(RevisionRequest $request, Revision $revision)
    {
        if (!$revision->exists) {
            return response()->view('revision::admin.revision.new', compact('revision'));
        }

        Form::populate($revision);
        return response()->view('revision::admin.revision.show', compact('revision'));
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

        $revision = $this->repository->newInstance([]);

        Form::populate($revision);

        return response()->view('revision::admin.revision.create', compact('revision'));

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
            $revision          = $this->repository->create($attributes);

            return response()->json([
                'message'  => trans('messages.success.updated', ['Module' => trans('revision::revision.name')]),
                'code'     => 204,
                'redirect' => trans_url('/admin/revision/revision/'.$revision->getRouteKey())
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
     * @param Model   $revision
     *
     * @return Response
     */
    public function edit(RevisionRequest $request, Revision $revision)
    {
        Form::populate($revision);
        return  response()->view('revision::admin.revision.edit', compact('revision'));
    }

    /**
     * Update the revision.
     *
     * @param Request $request
     * @param Model   $revision
     *
     * @return Response
     */
    public function update(RevisionRequest $request, Revision $revision)
    {
        try {

            $attributes = $request->all();

            $revision->update($attributes);

            return response()->json([
                'message'  => trans('messages.success.updated', ['Module' => trans('revision::revision.name')]),
                'code'     => 204,
                'redirect' => trans_url('/admin/revision/revision/'.$revision->getRouteKey())
            ], 201);

        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 400,
                'redirect' => trans_url('/admin/revision/revision/'.$revision->getRouteKey()),
            ], 400);

        }
    }

    /**
     * Remove the revision.
     *
     * @param Model   $revision
     *
     * @return Response
     */
    public function destroy(RevisionRequest $request, Revision $revision)
    {

        try {

            $t = $revision->delete();

            return response()->json([
                'message'  => trans('messages.success.deleted', ['Module' => trans('revision::revision.name')]),
                'code'     => 202,
                'data'     => $revision,
                'redirect' => trans_url('/admin/revision/revision'),
            ], 202);

           /* return redirect(trans_url('/user/testimonial/testimonial'))
                ->with('message', trans('messages.success.deleted', ['Module' => trans('testimonial::testimonial.name')]))
                ->with('code', 204);*/

        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 400,
                'redirect' => trans_url('/admin/revision/revision/'.$revision->getRouteKey()),
            ], 400);
        }
    }
}