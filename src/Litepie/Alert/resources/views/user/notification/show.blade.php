@include('public::notifications')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h4 class="text-dark  header-title m-t-0"> Details of {!! $notification['name'] !!} </h4>
        </div>
        <div class="col-md-6">
            <div class='pull-right'>
                <a href="{{ trans_url('/user/alert/notification') }}" class="btn btn-default"> {{ trans('app.back')  }}</a>
                <a href="{{ trans_url('/user/alert/notification') }}/{{ notification->getRouteKey() }}/edit" class="btn btn-success"> {{ trans('app.edit')  }}</a>
                <a href="{{ trans_url('/user/alert/notification') }}/{{ notification->getRouteKey() }}/copy" class="btn btn-warning"> {{ trans('app.copy')  }}</a>
                <a href="{{ trans_url('/user/alert/notification') }}/{{ notification->getRouteKey() }}/delete" class="btn btn-danger"> {{ trans('app.delete')  }}</a>
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
                <label for="type">
                    {!! trans('alert::notification.label.type') !!}
                </label><br />
                    {!! $notification['type'] !!}
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class"form-group">
                <label for="notifiable_id">
                    {!! trans('alert::notification.label.notifiable_id') !!}
                </label><br />
                    {!! $notification['notifiable_id'] !!}
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class"form-group">
                <label for="notifiable_type">
                    {!! trans('alert::notification.label.notifiable_type') !!}
                </label><br />
                    {!! $notification['notifiable_type'] !!}
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class"form-group">
                <label for="data">
                    {!! trans('alert::notification.label.data') !!}
                </label><br />
                    {!! $notification['data'] !!}
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class"form-group">
                <label for="read_at">
                    {!! trans('alert::notification.label.read_at') !!}
                </label><br />
                    {!! $notification['read_at'] !!}
            </div>
        </div>
    </div>
</div>