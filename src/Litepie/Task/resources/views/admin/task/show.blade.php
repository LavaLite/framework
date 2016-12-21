<div class="nav-tabs-custom">
    <ul class="nav nav-tabs primary">
        <li class="active"><a href="#details" data-toggle="tab">  {!! trans('task::task.name') !!}</a></li>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-success btn-sm" data-action='NEW' data-load-to='#task-task-entry' data-href='{{trans_url('admin/task/task/create')}}'><i class="fa fa-plus-circle"></i> New</button>
            @if($task['id'] )
            <button type="button" class="btn btn-primary btn-sm" data-action="EDIT" data-load-to='#task-task-entry' data-href='{{ trans_url('/admin/task/task') }}/{{$task->getRouteKey()}}/edit'><i class="fa fa-pencil-square"></i> Edit</button>
            <button type="button" class="btn btn-danger btn-sm" data-action="DELETE" data-load-to='#task-task-entry' data-datatable='#task-task-list' data-href='{{ trans_url('/admin/task/task') }}/{{$task->getRouteKey()}}' >
            <i class="fa fa-times-circle"></i> Delete
            </button>
            @endif

        </div>
    </ul>
    {!!Form::vertical_open()
    ->id('task-task-show')
    ->method('POST')
    ->files('true')
    ->action(trans_url('admin/task/task'))!!}
        <div class="tab-content clearfix">
            <div class="tab-pane active" id="details">
                <div class="tab-pan-title">  {!! trans('app.view') !!}  {!! trans('task::task.name') !!} [{!!$task->name!!}] </div>
                @include('task::admin.task.partial.entry')
            </div>
        </div>
    {!! Form::close() !!}
</div>