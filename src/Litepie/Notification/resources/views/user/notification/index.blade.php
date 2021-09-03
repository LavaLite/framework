<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header with-sub" data-background-color="red">
                        <div class="row">
                            <div class="col-sm-8 title-main">
                                <i class="pe-7s-display2"></i>
                                <h4 class="title">{!! trans('alerts::notification.title.user') !!}</h4>
                                <p class="sub-title">{!! trans('alerts::notification.title.sub.user') !!}</p>
                            </div>
                            <div class="col-sm-4">
                                <div class="header-form">
                                    {!!Form::open()
                                   ->method('GET')
                                   ->class('form pn')
                                   ->alerts(guard_url('/alerts/notification'))!!}
                                    <div class="form-group form-white mn">
                                      {!!Form::text('search')->type('text')->placeholder('Search')->raw()!!}
                                    </div>
                                    <button type="submit" class="btn btn-icon btn-round btn-white btn-raised search-btn"><i class="fa fa-search"></i></button>
                                    {!! Form::close()!!}
                                    <a href="{!!guard_url('/alerts/notification/create')!!}" rel="tooltip" class="btn btn-white btn-round btn-simple btn-icon pull-right add-new" data-original-title="" title="">
                                        <i class="fa fa-plus-circle"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content table-responsive table-full-width">
                        @include('public::notifications')
                        <table class="table table-bigboy">
                            <thead>
                                <tr>
                                    <th class="text-center">Image</th>
                                    <th>{!! trans('alerts::notification.label.type')!!}</th>
                    <th>{!! trans('alerts::notification.label.notifiable_id')!!}</th>
                    <th>{!! trans('alerts::notification.label.notifiable_type')!!}</th>
                    <th>{!! trans('alerts::notification.label.data')!!}</th>
                    <th>{!! trans('alerts::notification.label.read_at')!!}</th>
                    <th>{!! trans('alerts::notification.label.status')!!}</th>
                    <th>{!! trans('alerts::notification.label.created_at')!!}</th>
                    <th>{!! trans('alerts::notification.label.updated_at')!!}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($notifications as $notification)
                                <tr>
                                    <td>
                                        <div class="img-container">
                                            <a href="{{trans_url('notification')}}/{{$notification->getPublickey()}}">
                                              <img alt="" class="img-responsive" src="{!!url($notification->defaultImage('sm','images'))!!}">
                                            </a>
                                        </div>
                                    </td>
                                    <td>{{ $notification->type }}</td>
                    <td>{{ $notification->notifiable_id }}</td>
                    <td>{{ $notification->notifiable_type }}</td>
                    <td>{{ $notification->data }}</td>
                    <td>{{ $notification->read_at }}</td>
                                    <td class="td-alerts">
                                        <a href="{{trans_url('notification')}}/{!!$notification->getRouteKey()!!}" rel="tooltip" data-toggle="tooltip" data-placement="top" title="View Notification" class="btn btn-info btn-simple">
                                            <i class="material-icons">panorama</i>
                                        </a>
                                        <a href="{!! guard_url('/alerts/notification') !!}/{!! $notification->getRouteKey() !!}/edit" rel="tooltip" data-toggle="tooltip" data-placement="top" title="Edit Notification" class="btn btn-success btn-simple">
                                            <i class="material-icons">edit</i>
                                        </a>
                                        <a rel="tooltip" data-toggle="tooltip" data-placement="top" title="Remove Notification" class="btn btn-danger btn-simple" data-alerts="DELETE" data-href="{!! guard_url('/alerts/notification') !!}/{!! $notification->getRouteKey() !!}" data-remove="{!! $notification->getRouteKey() !!}">
                                            <i class="material-icons">close</i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td><h4>No notifications found.</h4></td>
                                </tr>
                                @endif
                                
                            </tbody>
                        </table>
                    </div>
                    <div class="footer">
                        {{$notifications->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>