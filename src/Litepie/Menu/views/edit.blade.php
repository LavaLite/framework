<div class="box-header with-border">
    <h3 class="box-title"> View menu [{!!$menu->name or 'New menu'!!}]</h3>
    <div class="box-tools pull-right">
        <button type="button" class="btn btn-primary btn-sm" data-action='UPDATE' data-form='#edit-menu'  data-load-to='#menu-entry'><i class="fa fa-floppy-o"></i> {{ trans('cms.save') }}</button>
        <button type="button" class="btn btn-default btn-sm" data-action='CANCEL' data-load-to='#menu-entry' data-href='{!!Trans::to('admin/menu/menu')!!}/{!!$menu->getRouteKey()!!}'><i class="fa fa-times-circle"></i> {{ trans('cms.cancel') }}</button>
        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
    </div>
</div>
<div class="box-body" >
    <div class="nav-tabs-custom">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs primary">
            <li class="active"><a href="#details" data-toggle="tab">Menu</a></li>
        </ul>
        {!!Form::vertical_open()
        ->id('edit-menu')
        ->method('PUT')
        ->action(Trans::to('admin/menu/menu/'. $menu->getRouteKey()))!!}
        {!!Form::token()!!}
        {!!Form::hidden('upload_folder')!!}
        <div class="tab-content">
            @include('Menu::partial.menu')
        </div>
        {!!Form::close()!!}
    </div>
</div>
<div class="box-footer" >
    &nbsp;
</div>