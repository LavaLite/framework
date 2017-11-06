<?php

namespace Litepie\Workflow\Http\Controllers;

use App\Http\Controllers\ResourceController as BaseController;
use Form;
use Litepie\Workflow\Http\Requests\WorkflowRequest;
use Litepie\Workflow\Interfaces\WorkflowRepositoryInterface;
use Litepie\Workflow\Models\Workflow;

/**
 * Admin web controller class.
 */
class WorkflowResourceController extends BaseController
{

// use WorkflowWorkflow;
    /**
     * Initialize workflow controller.
     *
     * @param type WorkflowRepositoryInterface $workflow
     *
     * @return type
     */
    public function __construct(WorkflowRepositoryInterface $workflow)
    {
        $this->repository = $workflow;
        parent::__construct();
    }

    /**
     * Display a list of workflow.
     *
     * @return Response
     */
    public function index(WorkflowRequest $request)
    {
        if ($request->wantsJson()) {
            return $this->getJson($request);
        }

        $this->response->title(trans('workflow::workflow.names'))
            ->view('workflow::workflow.index', true)
            ->output();
    }

    /**
     * Display a list of workflow.
     *
     * @return Response
     */
    public function getJson(WorkflowRequest $request)
    {
        $pageLimit = $request->input('pageLimit');

        $workflows = $this->repository
            ->pushCriteria(app('Litepie\Repository\Criteria\RequestCriteria'))
            ->setPresenter('\\Litepie\\Workflow\\Repositories\\Presenter\\WorkflowListPresenter')
            ->scopeQuery(function ($query) {
                return $query->orderBy('id', 'DESC');
            })->paginate($pageLimit);
        $workflows['recordsTotal']    = $workflows['meta']['pagination']['total'];
        $workflows['recordsFiltered'] = $workflows['meta']['pagination']['total'];
        $workflows['request']         = $request->all();
        return response()->json($workflows, 200);

    }

    /**
     * Display workflow.
     *
     * @param Request $request
     * @param Model   $workflow
     *
     * @return Response
     */
    public function show(WorkflowRequest $request, Workflow $workflow)
    {
        if (!$workflow->exists) {
            return response()->view('workflow::admin.workflow.new', compact('workflow'));
        }

        Form::populate($workflow);
        return response()->view('workflow::admin.workflow.show', compact('workflow'));
    }

    /**
     * Show the form for creating a new workflow.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function create(WorkflowRequest $request)
    {

        $workflow = $this->repository->newInstance([]);

        Form::populate($workflow);

        return response()->view('workflow::admin.workflow.create', compact('workflow'));

    }

    /**
     * Create new workflow.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(WorkflowRequest $request)
    {
        try {
            $attributes            = $request->all();
            $attributes['user_id'] = user_id('admin.web');
            $workflow              = $this->repository->create($attributes);

            return response()->json([
                'message'  => trans('messages.success.updated', ['Module' => trans('workflow::workflow.name')]),
                'code'     => 204,
                'redirect' => trans_url('/admin/workflow/workflow/' . $workflow->getRouteKey()),
            ], 201);

        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'code'    => 400,
            ], 400);
        }

    }

    /**
     * Show workflow for editing.
     *
     * @param Request $request
     * @param Model   $workflow
     *
     * @return Response
     */
    public function edit(WorkflowRequest $request, Workflow $workflow)
    {
        Form::populate($workflow);
        return response()->view('workflow::admin.workflow.edit', compact('workflow'));
    }

    /**
     * Update the workflow.
     *
     * @param Request $request
     * @param Model   $workflow
     *
     * @return Response
     */
    public function update(WorkflowRequest $request, Workflow $workflow)
    {
        try {

            $attributes = $request->all();

            $workflow->update($attributes);

            return response()->json([
                'message'  => trans('messages.success.updated', ['Module' => trans('workflow::workflow.name')]),
                'code'     => 204,
                'redirect' => trans_url('/admin/workflow/workflow/' . $workflow->getRouteKey()),
            ], 201);

        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 400,
                'redirect' => trans_url('/admin/workflow/workflow/' . $workflow->getRouteKey()),
            ], 400);

        }

    }

    /**
     * Remove the workflow.
     *
     * @param Model   $workflow
     *
     * @return Response
     */
    public function destroy(WorkflowRequest $request, Workflow $workflow)
    {

        try {

            $t = $workflow->delete();

            return response()->json([
                'message'  => trans('messages.success.deleted', ['Module' => trans('workflow::workflow.name')]),
                'code'     => 202,
                'redirect' => trans_url('/admin/workflow/workflow/0'),
            ], 202);

        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 400,
                'redirect' => trans_url('/admin/workflow/workflow/' . $workflow->getRouteKey()),
            ], 400);
        }

    }

    /**
     * Display a list of workflow.
     *
     * @return Response
     */
    public function getWorkflow(WorkflowRequest $request)
    {
        if ($request->wantsJson()) {
            $pageLimit = $request->input('pageLimit');
            $workflows = $this->repository
                ->pushCriteria(app('Litepie\Repository\Criteria\RequestCriteria'))
                ->setPresenter('\\Litepie\\Workflow\\Repositories\\Presenter\\WorkflowListPresenter')
                ->scopeQuery(function ($query) use ($model, $id) {
                    return $query->orderBy('id', 'DESC');
                })->paginate($pageLimit);
            $workflows['recordsTotal']    = $workflows['meta']['pagination']['total'];
            $workflows['recordsFiltered'] = $workflows['meta']['pagination']['total'];
            $workflows['request']         = $request->all();
            return response()->json($workflows, 200);
        }

        $this->response->title(trans('workflow::workflow.names') . ' :: ');
        return view('workflow::admin.workflow.workflow')->output();
    }

}
