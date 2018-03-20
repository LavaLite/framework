<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-file-text-o"></i> {!! trans('settings::setting.name') !!} <small> {!! trans('app.manage') !!} {!! trans('settings::setting.names') !!}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{!! guard_url('/') !!}"><i class="fa fa-dashboard"></i> {!! trans('app.home') !!} </a></li>
            <li class="active">{!! trans('settings::setting.names') !!}</li>
        </ol>
    </section>

    <section class="content">
        <!-- Main content -->
            {!!Form::vertical_open()
            ->id('settings-setting-create')
            ->method('POST')
            ->files('true')
            ->action(URL::to('admin/settings/setting'))!!}
        <div class="nav-tabs-custom">
        <!-- Nav tabs -->
            <ul class="nav nav-tabs primary">
                <li class="active"><a href="#main" data-toggle="tab">Main</a></li>
                <li><a href="#user" data-toggle="tab">User</a></li>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-primary btn-sm" data-action='CREATE' data-form='#settings-setting-create'  data-load-to='#settings-setting-entry' data-datatable='#settings-setting-list'><i class="fa fa-floppy-o"></i> {{ trans('app.save') }}</button>
                    <button type="reset" class="btn btn-default btn-sm"><i class="fa fa-times-circle"></i> {{ trans('app.close') }}</button>
                </div>
            </ul>
            <div class="tab-content clearfix">
                <div class="tab-pane active" id="main">
                    @include('settings::admin.setting.partial.main')
                </div>
                <div class="tab-pane" id="user">
                    @include('settings::admin.setting.partial.user')
                </div>          
            </div>
        </div>
            {!! Form::close() !!}
    </section>
</div>