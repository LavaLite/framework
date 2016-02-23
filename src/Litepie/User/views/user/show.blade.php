<div class="box-header with-border">
    <h3 class="box-title"> {{ trans('cms.view') }}   {{ trans('user.user.name') }}  [{{ $user->name }}]  </h3>
       <div class="box-tools pull-right">
        <button type="button" class="btn btn-success btn-sm" data-action='NEW' data-load-to='#entry-user' data-href='{{Trans::to('admin/page/page/create')}}'><i class="fa fa-times-circle"></i> {{ trans('cms.new') }}</button>
        @if($user->id)
        <button type="button" class="btn btn-primary btn-sm" data-action="EDIT" data-load-to='#entry-user' data-href='{{ trans_url('/admin/user/user') }}/{{$user->getRouteKey()}}/edit'><i class="fa fa-pencil-square"></i> {{ trans('cms.edit') }}</button>
        <button type="button" class="btn btn-danger btn-sm" data-action="DELETE" data-load-to='#entry-user' data-datatable='#main-list' data-href='{{ trans_url('/admin/user/user') }}/{{$user->getRouteKey()}}' >
            <i class="fa fa-times-circle"></i> {{ trans('cms.delete') }}
        </button>
        @endif
        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
    </div>
</div>
<div class="box-body" >
    <div class="nav-tabs-custom">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs primary">
            <li class="active"><a href="#details" data-toggle="tab">Profile</a></li>
            <li><a href="#roles" data-toggle="tab">Details</a></li>
        </ul>
        {!!Form::vertical_open()
        ->id('user-user-show')
        ->method('PUT')
        ->action(trans_url('admin/user/user/'. $user->getRouteKey()))!!}
            <div class="tab-content">
                @include('User::user.partial.entry')
            </div>
        {!! Form::close() !!}
    </div>
</div>
<div class="box-footer" >
    &nbsp;
</div>
