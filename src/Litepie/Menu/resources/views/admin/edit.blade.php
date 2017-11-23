
    <div class="nav-tabs-custom">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs primary">
            <li class="active"><a href="#details" data-toggle="tab">Menu</a></li>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-primary btn-sm" data-action='UPDATE' data-form='#edit-menu'  data-load-to='#menu-entry' data-href='{!!guard_url('menu/menu')!!}/{!!$menu->getRouteKey()!!}'><i class="fa fa-floppy-o"></i> {{ trans('app.save') }}</button>
                <button type="button" class="btn btn-default btn-sm" data-action='CANCEL' data-load-to='#menu-entry' data-href='{!!guard_url('menu/menu')!!}/{!!$menu->getRouteKey()!!}'><i class="fa fa-times-circle"></i> {{ trans('app.cancel') }}</button>
            </div>
        </ul>
        {!!Form::vertical_open()
        ->id('edit-menu')
        ->method('PUT')
        ->action(guard_url('menu/menu/'. $menu->getRouteKey()))!!}
        {!!Form::token()!!}
        {!!Form::hidden('upload_folder')!!}
        <div class="tab-content">
            @include('menu::admin.partial.menu')
        </div>
        {!!Form::close()!!}
    </div>
