
    <div class="nav-tabs-custom">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs primary">
            <li class="active"><a href="#details" data-toggle="tab">Menu</a></li>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-primary btn-sm" data-action='UPDATE' data-form='#edit-menu' data-load-to='#menu-entry' data-href='{!!guard_url('menu/submenu')!!}/{!!$menu->getRouteKey()!!}' id="btn-save"><i class="fa fa-floppy-o"></i> {{ trans('app.save') }}</button>
                <button type="button" class="btn btn-default btn-sm" data-action='CANCEL' data-load-to='#menu-entry' data-href='{!!guard_url('menu/submenu')!!}/{!!$menu->getRouteKey()!!}' id="btn-cancel"><i class="fa fa-times-circle"></i> {{ trans('app.cancel') }}</button>
            </div>
        </ul>
        {!!Form::vertical_open()
        ->id('edit-menu')
        ->method('PUT')
        ->files('true')
        ->enctype('multipart/form-data')
        ->action(guard_url('menu/submenu/'. $menu->getRouteKey()))!!}
        <div class="tab-content">
            @include('menu::admin.partial.submenu')
        </div>
        {!!Form::close()!!}
    </div>
