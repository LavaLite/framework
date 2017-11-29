@include('public::notifications')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h4 class="text-dark  header-title m-t-0"> Details of {!! $task['name'] !!} </h4>
        </div>
        <div class="col-md-6">
            <div class='pull-right'>
                <a href="{{ guard_url('task/task') }}" class="btn btn-default"> {{ trans('app.back')  }}</a>
                <a href="{{ guard_url('task/task') }}/{{ task->getRouteKey() }}/edit" class="btn btn-success"> {{ trans('app.edit')  }}</a>
                <a href="{{ guard_url('task/task') }}/{{ task->getRouteKey() }}/copy" class="btn btn-warning"> {{ trans('app.copy')  }}</a>
                <a href="{{ guard_url('task/task') }}/{{ task->getRouteKey() }}/delete" class="btn btn-danger"> {{ trans('app.delete')  }}</a>
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
                <label for="parent_id">
                    {!! trans('task::task.label.parent_id') !!}
                </label><br />
                    {!! $task['parent_id'] !!}
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class"form-group">
                <label for="start">
                    {!! trans('task::task.label.start') !!}
                </label><br />
                    {!! $task['start'] !!}
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class"form-group">
                <label for="end">
                    {!! trans('task::task.label.end') !!}
                </label><br />
                    {!! $task['end'] !!}
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class"form-group">
                <label for="category">
                    {!! trans('task::task.label.category') !!}
                </label><br />
                    {!! $task['category'] !!}
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class"form-group">
                <label for="task">
                    {!! trans('task::task.label.task') !!}
                </label><br />
                    {!! $task['task'] !!}
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class"form-group">
                <label for="time_required">
                    {!! trans('task::task.label.time_required') !!}
                </label><br />
                    {!! $task['time_required'] !!}
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class"form-group">
                <label for="time_taken">
                    {!! trans('task::task.label.time_taken') !!}
                </label><br />
                    {!! $task['time_taken'] !!}
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class"form-group">
                <label for="priority">
                    {!! trans('task::task.label.priority') !!}
                </label><br />
                    {!! $task['priority'] !!}
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class"form-group">
                <label for="status">
                    {!! trans('task::task.label.status') !!}
                </label><br />
                    {!! $task['status'] !!}
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class"form-group">
                <label for="created_by">
                    {!! trans('task::task.label.created_by') !!}
                </label><br />
                    {!! $task['created_by'] !!}
            </div>
        </div>
    </div>
</div>