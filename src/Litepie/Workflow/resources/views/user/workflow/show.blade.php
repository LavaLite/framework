@include('public::notifications')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h4 class="text-dark  header-title m-t-0"> Details of {!! $workflow['name'] !!} </h4>
        </div>
        <div class="col-md-6">
            <div class='pull-right'>
                <a href="{{ trans_url('/user/workflow/workflow') }}" class="btn btn-default"> {{ trans('app.back')  }}</a>
                <a href="{{ trans_url('/user/workflow/workflow') }}/{{ workflow->getRouteKey() }}/edit" class="btn btn-success"> {{ trans('app.edit')  }}</a>
                <a href="{{ trans_url('/user/workflow/workflow') }}/{{ workflow->getRouteKey() }}/copy" class="btn btn-warning"> {{ trans('app.copy')  }}</a>
                <a href="{{ trans_url('/user/workflow/workflow') }}/{{ workflow->getRouteKey() }}/delete" class="btn btn-danger"> {{ trans('app.delete')  }}</a>
            </div>
        </div>
    </div>
    <p class="text-muted m-b-25 font-13">
        Your awesome text goes here.
    </p>
    <hr/>

    <div class="row">
        <div class="col-md-4 col-sm-6">
            <div class"form-group">
                <label for="workflowable_id">
                    {!! trans('workflow::workflow.label.workflowable_id') !!}
                </label><br />
                    {!! $workflow['workflowable_id'] !!}
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class"form-group">
                <label for="workflowable_type">
                    {!! trans('workflow::workflow.label.workflowable_type') !!}
                </label><br />
                    {!! $workflow['workflowable_type'] !!}
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class"form-group">
                <label for="action">
                    {!! trans('workflow::workflow.label.action') !!}
                </label><br />
                    {!! $workflow['action'] !!}
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class"form-group">
                <label for="status">
                    {!! trans('workflow::workflow.label.status') !!}
                </label><br />
                    {!! $workflow['status'] !!}
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class"form-group">
                <label for="comment">
                    {!! trans('workflow::workflow.label.comment') !!}
                </label><br />
                    {!! $workflow['comment'] !!}
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class"form-group">
                <label for="data">
                    {!! trans('workflow::workflow.label.data') !!}
                </label><br />
                    {!! $workflow['data'] !!}
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class"form-group">
                <label for="performable_id">
                    {!! trans('workflow::workflow.label.performable_id') !!}
                </label><br />
                    {!! $workflow['performable_id'] !!}
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class"form-group">
                <label for="performable_type">
                    {!! trans('workflow::workflow.label.performable_type') !!}
                </label><br />
                    {!! $workflow['performable_type'] !!}
            </div>
        </div>
    </div>
</div>