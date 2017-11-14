<?php

namespace Litepie\Workflow\Http\Controllers;

use App\Http\Controllers\PublicController as BaseController;
use Litepie\Workflow\Interfaces\WorkflowRepositoryInterface;
use Litepie\Workflow\Models\Workflow;
use Litepie\Workflow\Model\Workflow as WorkflowTrait;
use Illuminate\Http\Request;
use User;
class WorkflowPublicController extends BaseController
{
    use WorkflowTrait;
    /**
     * Constructor.
     *
     * @param type \Litepie\Workflow\Interfaces\WorkflowRepositoryInterface $workflow
     *
     * @return type
     */
    public function __construct(WorkflowRepositoryInterface $workflow)
    {
        $this->repository = $workflow;
        parent::__construct();
    }

    /**
     * Show workflow's list.
     *
     * @param string $slug
     *
     * @return response
     */
    protected function index()
    {
        $workflow = $this->repository
            ->pushCriteria(app('Litepie\Repository\Criteria\RequestCriteria'))
            ->scopeQuery(function ($query) {
                return $query->orderBy('id', 'DESC');
            })->paginate();
    }

    /**
     * Show workflow.
     *
     * @param string $slug
     *
     * @return response
     */
    protected function show($slug)
    {
        $workflow = $this->repository->scopeQuery(function ($query) use ($slug) {
            return $query->orderBy('id', 'DESC')
                ->where('slug', $slug);
        })->first(['*']);
    }


    /**
     * Workflow controller function for workflow.
     *
     * @param Model   $workflow
     * @param step    next step for the workflow.
     * @param user    encrypted user id.
     *
     * @return Response
     */

    public function getWorkflow($id)
    {
        $fields = [];    
        $workflow = $this->repository
                ->pushCriteria(app('Litepie\Repository\Criteria\RequestCriteria'))
                ->scopeQuery(function ($query) use($id){
                    return $query->whereId($id)->orderBy('id', 'DESC');
                })->first();

        if (empty($workflow)  || $workflow->status <> 'pending' ) {
            return $this->theme->layout('blank')->of('workflow::admin.workflow.error', compact('workflow'))->output();
        }        

        if($workflow->workflowable->addInfo($workflow->action) ){
            $view = $workflow->workflowable->workflow['steps'][$workflow->action]['addlinfo'];
            if (!strpos( $view, '::' )) {
                $view = 'workflow::admin.workflow.'.$view;
            }
            
            $this->response->title(trans('workflow::workflow.names').' :: ');
            return $this->theme->layout('blank')->of('workflow::admin.workflow.public', compact('workflow', 'view'))->output();
        }

        return $this->workflow($workflow, []);
    }

    public function postWorkflow(Request $request, $id)
    {
        $workflow = $this->repository
                ->pushCriteria(app('Litepie\Repository\Criteria\RequestCriteria'))
                ->scopeQuery(function ($query) use($id){
                    return $query->whereId($id)->orderBy('id', 'DESC');
                })->first();

        return $this->workflow($workflow, $request->all());
    }

    public function workflow($workflow, $comments)
    {
        try {
            User::onceUsingId($workflow->performable->id, $workflow->guard);
            //putenv('guard='. $workflow->guard);
            //putenv('auth.model='. $workflow->performable_type);
            unset($comments['_token']);
            $workflow->workflowable->applyWorkflow($workflow->action, $comments);

            $data = [
                'message' => trans('messages.success.changed', ['Module' => trans('workflow::workflow.name'), 'status' => trans("app.{$workflow->action}")]),
                'status'  => 'success',
                'step'    => trans("app.{$workflow->action}"),
            ];

            return $this->theme->layout('blank')->of('workflow::admin.workflow.message', $data)->output();

        } catch (ValidationException $e) {

            $data = [
                'message' => '<b>' . $e->getMessage() . '</b> <br /><br />' . implode('<br />', $e->validator->errors()->all()),
                'status'  => 'error',
                'step'    => trans("app.{$workflow->action}"),
            ];

            return $this->theme->layout('blank')->of('workflow::admin.workflow.message', $data)->output();

        } 
    }

    
}
