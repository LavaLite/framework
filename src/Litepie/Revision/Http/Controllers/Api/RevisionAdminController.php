<?php

namespace Litepie\Revision\Http\Controllers\Api;

use App\Http\Controllers\Api\AdminController as BaseController;
use Litepie\Revision\Http\Requests\RevisionRequest;
use Litepie\Revision\Interfaces\RevisionRepositoryInterface;
use Litepie\Revision\Models\Revision;

/**
 * Admin API controller class.
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
     * @return json
     */
    public function index(RevisionRequest $request)
    {
        $revision  = $this->repository
            ->setPresenter('\\Litepie\\Revision\\Repositories\\Presenter\\RevisionListPresenter')
            ->scopeQuery(function($query){
                return $query->orderBy('id','DESC');
            })->all();
        $revision['code'] = 2000;
        return response()->json($revision) 
                         ->setStatusCode(200, 'INDEX_SUCCESS');

    }

    /**
     * Display revision.
     *
     * @param Request $request
     * @param Model   Revision
     *
     * @return Json
     */
    public function show(RevisionRequest $request, Revision $revision)
    {
        $revision         = $revision->presenter();
        $revision['code'] = 2001;
        return response()->json($revision)
                         ->setStatusCode(200, 'SHOW_SUCCESS');;

    }

    /**
     * Show the form for creating a new revision.
     *
     * @param Request $request
     *
     * @return json
     */
    public function create(RevisionRequest $request, Revision $revision)
    {
        $revision         = $revision->presenter();
        $revision['code'] = 2002;
        return response()->json($revision)
                         ->setStatusCode(200, 'CREATE_SUCCESS');

    }

    /**
     * Create new revision.
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
            $revision          = $this->repository->create($attributes);
            $revision          = $revision->presenter();
            $revision['code']  = 2004;

            return response()->json($revision)
                             ->setStatusCode(201, 'STORE_SUCCESS');
        } catch (Exception $e) {
            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 4004,
            ])->setStatusCode(400, 'STORE_ERROR');
        }
    }

    /**
     * Show revision for editing.
     *
     * @param Request $request
     * @param Model   $revision
     *
     * @return json
     */
    public function edit(RevisionRequest $request, Revision $revision)
    {
        $revision         = $revision->presenter();
        $revision['code'] = 2003;
        return response()-> json($revision)
                        ->setStatusCode(200, 'EDIT_SUCCESS');;
    }

    /**
     * Update the revision.
     *
     * @param Request $request
     * @param Model   $revision
     *
     * @return json
     */
    public function update(RevisionRequest $request, Revision $revision)
    {
        try {

            $attributes = $request->all();

            $revision->update($attributes);
            $revision         = $revision->presenter();
            $revision['code'] = 2005;

            return response()->json($revision)
                             ->setStatusCode(201, 'UPDATE_SUCCESS');


        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 4005,
            ])->setStatusCode(400, 'UPDATE_ERROR');

        }
    }

    /**
     * Remove the revision.
     *
     * @param Request $request
     * @param Model   $revision
     *
     * @return json
     */
    public function destroy(RevisionRequest $request, Revision $revision)
    {

        try {

            $t = $revision->delete();

            return response()->json([
                'message'  => trans('messages.success.deleted', ['Module' => trans('revision::revision.name')]),
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
