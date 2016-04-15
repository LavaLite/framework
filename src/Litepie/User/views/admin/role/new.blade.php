<div class="box-header with-border">
    <h3 class="box-title">  {!! trans('user.role.names') !!}</h3>
    <div class="box-tools pull-right">
        <button type="button" class="btn btn-success btn-sm" data-action='NEW' data-load-to='#user-role-entry' data-href='{{trans_url('admin/user/role/create')}}'><i class="fa fa-times-circle"></i> New</button>
        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
    </div>
</div>
<div class="box-body" style="min-height:100px">
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <h1 class="text-center">
            <small>
            <button type="button" class="btn btn-app" data-toggle="tooltip" data-placement="top" title=""  data-action='NEW' data-load-to='#user-role-entry' data-href='{{trans_url('admin/user/role/create')}}'>
            <span class="badge bg-purple">{!! User::count('role') !!}</span>
            <i class="fa fa-plus-circle  fa-3x"></i>
            {{ trans('cms.create') }} {!! trans('user.role.name') !!}
            </button>
            <br>{!! trans('user.role.text.preview') !!}
            </small>
            </h1>
        </div>
    </div>
</div>
<div class="box-footer" >
    &nbsp;
</div>
