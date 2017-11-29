@include('public::notifications')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h4 class="text-dark  header-title m-t-0"> {{ trans('app.create')  }} Task </h4>
        </div>
        <div class="col-md-6">
            <a href="{{ guard_url('task/task') }}" class="btn btn-default pull-right"> {{ trans('app.back')  }}</a>
        </div>
    </div>
    <p class="text-muted m-b-25 font-13">
        Your awesome text goes here.
    </p>
    <hr/>

    {!!Form::horizontal_open()
    ->id('create-task-task')
    ->method('POST')
    ->files('true')
    ->action(guard_url('task/task'))!!}
            @include('task::user.task.partial.entry')
    {!! Form::close() !!}
</div>