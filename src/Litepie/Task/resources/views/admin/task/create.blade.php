
    <div class="nav-tabs-custom">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs primary">
            <li class="active"><a href="#details" data-toggle="tab">Contact</a></li>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-primary btn-sm" data-action='CREATE' data-form='#task-task-create'  data-load-to='#task-task-entry' data-datatable='#task-task-list'><i class="fa fa-floppy-o"></i> Save</button>
                <button type="button" class="btn btn-default btn-sm" data-action='CLOSE' data-load-to='#task-task-entry' data-href='{{trans_url('admin/task/task/0')}}'><i class="fa fa-times-circle"></i> {{ trans('app.close') }}</button>
            </div>
        </ul>
        {!!Form::vertical_open()
        ->id('task-task-create')
        ->method('POST')
        ->files('true')
        ->action(trans_url('admin/task/task'))!!}
        <div class="tab-content clearfix">
            <div class="tab-pane active" id="details">
                <div class="tab-pan-title"> {{ trans('app.new') }}  {!! trans('task::task.name') !!} </div>
                @include('task::admin.task.partial.entry')
            </div>
        </div>
        {!! Form::close() !!}
    </div>