    <div class="nav-tabs-custom">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs primary">
            <li class="active"><a href="#details" data-toggle="tab">  {!! trans('workflow::workflow.name') !!}</a></li>
            <div class="box-tools pull-right">
                @include('workflow::admin.workflow.partial.workflow')
                <button type="button" class="btn btn-success btn-sm" data-action='NEW' data-load-to='#workflow-workflow-entry' data-href='{{trans_url('admin/workflow/workflow/create')}}'><i class="fa fa-times-circle"></i> {{ trans('app.new') }}</button>
                @if($workflow->id )
                <button type="button" class="btn btn-primary btn-sm" data-action="EDIT" data-load-to='#workflow-workflow-entry' data-href='{{ trans_url('/admin/workflow/workflow') }}/{{$workflow->getRouteKey()}}/edit'><i class="fa fa-pencil-square"></i> {{ trans('app.edit') }}</button>
                <button type="button" class="btn btn-danger btn-sm" data-action="DELETE" data-load-to='#workflow-workflow-entry' data-datatable='#workflow-workflow-list' data-href='{{ trans_url('/admin/workflow/workflow') }}/{{$workflow->getRouteKey()}}' >
                <i class="fa fa-times-circle"></i> {{ trans('app.delete') }}
                </button>
                @endif
            </div>
        </ul>
        {!!Form::vertical_open()
        ->id('workflow-workflow-show')
        ->method('POST')
        ->files('true')
        ->action(trans_url('admin/workflow/workflow'))!!}
            <div class="tab-comment clearfix">
                <div class="tab-pan-title"> {{ trans('app.view') }}   {!! trans('workflow::workflow.name') !!}  [{!! $workflow->name !!}] </div>
                <div class="tab-pane active" id="details">
                    @include('workflow::admin.workflow.partial.entry')
                </div>
            </div>
        {!! Form::close() !!}
    </div>