    <div class="nav-tabs-custom">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs primary">
            <li class="active"><a href="#workflow" data-toggle="tab">{!! trans('workflow::workflow.tab.name') !!}</a></li>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-primary btn-sm" data-action='UPDATE' data-form='#workflow-workflow-edit'  data-load-to='#workflow-workflow-entry' data-datatable='#workflow-workflow-list'><i class="fa fa-floppy-o"></i> {{ trans('app.save') }}</button>
                <button type="button" class="btn btn-default btn-sm" data-action='CANCEL' data-load-to='#workflow-workflow-entry' data-href='{{trans_url('admin/workflow/workflow')}}/{{$workflow->getRouteKey()}}'><i class="fa fa-times-circle"></i> {{ trans('app.cancel') }}</button>

            </div>
        </ul>
        {!!Form::vertical_open()
        ->id('workflow-workflow-edit')
        ->method('PUT')
        ->enctype('multipart/form-data')
        ->action(trans_url('admin/workflow/workflow/'. $workflow->getRouteKey()))!!}
        <div class="tab-comment clearfix">
            <div class="tab-pane active" id="workflow">
                <div class="tab-pan-title">  {{ trans('app.edit') }}  {!! trans('workflow::workflow.name') !!} [{!!$workflow->name!!}] </div>
                @include('workflow::admin.workflow.partial.entry')
            </div>
        </div>
        {!!Form::close()!!}
    </div>