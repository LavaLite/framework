<div class="box-header with-border">
    <h3 class="box-title"> {{ trans('cms.edit') }}  {{ trans('user.user.name') }} [{!!$user->name!!}] </h3>
    <div class="box-tools pull-right">
        <button type="button" class="btn btn-primary btn-sm" data-action='UPDATE' data-form='#edit-user'  data-load-to='#entry-user' data-datatable='#main-list'><i class="fa fa-floppy-o"></i> {{ trans('cms.save') }}</button>
        <button type="button" class="btn btn-default btn-sm" data-action='CANCEL' data-load-to='#entry-user' data-href='{{Trans::to('admin/user/user/0')}}'><i class="fa fa-times-circle"></i> {{ trans('cms.cancel') }}</button>
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
        ->id('edit-user')
        ->method('PUT')
        ->enctype('multipart/form-data')
        ->action(URL::to('admin/user/user/'. $user->getRouteKey()))!!}
        <div class="tab-content">
            @include('User::user.partial.entry')
        </div>
        {!!Form::close()!!}
    </div>
</div>
<div class="box-footer" >
    &nbsp;
</div>
