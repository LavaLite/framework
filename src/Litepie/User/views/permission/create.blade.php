<div class="box-header with-border">
    <h3 class="box-title"> {{ trans('cms.new') }}  {{ trans('user.permission.name') }} </h3>
    <div class="box-tools pull-right">
        <button type="button" class="btn btn-primary btn-sm" data-action='CREATE' data-form='#create-user-permission'  data-load-to='#entry-permission' data-datatable='#main-list'><i class="fa fa-floppy-o"></i> {{ trans('cms.save') }}</button>
        <button type="button" class="btn btn-default btn-sm" data-action='CANCEL' data-load-to='#entry-permission' data-href='{{Trans::to('admin/user/permission/0')}}'><i class="fa fa-times-circle"></i> {{ trans('cms.cancel') }}</button>
      <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
    </div>
</div>
<div class="box-body" >
    <div class="nav-tabs-custom">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs primary">
            <li class="active"><a href="#details" data-toggle="tab">{{ trans('user.permission.tab.name') }}</a></li>
        </ul>
        {!!Form::vertical_open()
        ->id('create-user-permission')
        ->method('POST')
        ->files('true')
        ->action(URL::to('admin/user/permission'))!!}
        <div class="tab-content">
            <div class="tab-pane active" id="details">
                @include('User::permission.partial.entry')
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
<div class="box-footer" >
    &nbsp;
</div>
