    <div class="nav-tabs-custom">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs primary">
            <li class="active"><a href="#details" data-toggle="tab">Workflow</a></li>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-primary btn-sm" data-action='CREATE' data-form='#workflow-workflow-create'  data-load-to='#workflow-workflow-entry' data-datatable='#workflow-workflow-list'><i class="fa fa-floppy-o"></i> {{ trans('app.save') }}</button>
                <button type="button" class="btn btn-default btn-sm" data-action='CLOSE' data-load-to='#workflow-workflow-entry' data-href='{{trans_url('admin/workflow/workflow/0')}}'><i class="fa fa-times-circle"></i> {{ trans('app.close') }}</button>
            </div>
        </ul>
        <div class="tab-comment clearfix">
            {!!Form::vertical_open()
            ->id('workflow-workflow-create')
            ->method('POST')
            ->files('true')
            ->action(trans_url('admin/workflow/workflow'))!!}
            <div class="tab-pane active" id="details">
                <div class="tab-pan-title">  {{ trans('app.new') }}  [{!! trans('workflow::workflow.name') !!}] </div>
                @include('workflow::admin.workflow.partial.entry')
            </div>
            {!! Form::close() !!}
        </div>
    </div>