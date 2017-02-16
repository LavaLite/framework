<?php

namespace Litepie\Workflow\Http\Controllers;

use App\Http\Controllers\UserController as BaseController;
use Form;
use Litepie\Workflow\Http\Requests\WorkflowRequest;
use Litepie\Workflow\Interfaces\WorkflowRepositoryInterface;
use Litepie\Workflow\Models\Workflow;

class WorkflowUserController extends BaseController
{
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
        $this->repository
                ->pushCriteria(app('Litepie\Repository\Criteria\RequestCriteria'))
                ->pushCriteria(new \Litepie\Workflow\Repositories\Criteria\WorkflowUserCriteria());
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(WorkflowRequest $request)
    {
        $workflows = $this->repository->scopeQuery(function($query){
            return $query->orderBy('id','DESC');
        })->paginate();

        $this->theme->prependTitle(trans('workflow::workflow.names'));

        return $this->theme->of('workflow::user.workflow.index', compact('workflows'))->render();
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Workflow $workflow
     *
     * @return Response
     */
    public function show(WorkflowRequest $request, Workflow $workflow)
    {
        Form::populate($workflow);

        return $this->theme->of('workflow::user.workflow.show', compact('workflow'))->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function create(WorkflowRequest $request)
    {

        $workflow = $this->repository->newInstance([]);
        Form::populate($workflow);

        $this->theme->prependTitle(trans('workflow::workflow.names'));
        return $this->theme->of('workflow::user.workflow.create', compact('workflow'))->render();
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(WorkflowRequest $request)
    {
        try {
            $attributes = $request->all();
            $attributes['user_id'] = user_id();
            $workflow = $this->repository->create($attributes);

            return redirect(trans_url('/user/workflow/workflow'))
                -> with('message', trans('messages.success.created', ['Module' => trans('workflow::workflow.name')]))
                -> with('code', 201);

        } catch (Exception $e) {
            redirect()->back()->withInput()->with('message', $e->getMessage())->with('code', 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param Workflow $workflow
     *
     * @return Response
     */
    public function edit(WorkflowRequest $request, Workflow $workflow)
    {

        Form::populate($workflow);
        $this->theme->prependTitle(trans('workflow::workflow.names'));

        return $this->theme->of('workflow::user.workflow.edit', compact('workflow'))->render();
    }

    /**
     * Update the specified resource.
     *
     * @param Request $request
     * @param Workflow $workflow
     *
     * @return Response
     */
    public function update(WorkflowRequest $request, Workflow $workflow)
    {
        try {
            $this->repository->update($request->all(), $workflow->getRouteKey());

            return redirect(trans_url('/user/workflow/workflow'))
                ->with('message', trans('messages.success.updated', ['Module' => trans('workflow::workflow.name')]))
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
    public function destroy(WorkflowRequest $request, Workflow $workflow)
    {
        try {
            $this->repository->delete($workflow->getRouteKey());
            return redirect(trans_url('/user/workflow/workflow'))
                ->with('message', trans('messages.success.deleted', ['Module' => trans('workflow::workflow.name')]))
                ->with('code', 204);

        } catch (Exception $e) {

            redirect()->back()->withInput()->with('message', $e->getMessage())->with('code', 400);

        }
    }
}
