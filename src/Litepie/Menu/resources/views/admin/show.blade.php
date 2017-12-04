
    <div class="nav-tabs-custom">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs primary">
            <li class="active"><a href="#details" data-toggle="tab">Menu [{{$menu->name}}]</a></li>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-success btn-sm" data-action="NEW" data-load-to='#menu-entry' data-href='{{guard_url('menu/submenu/create')}}?parent_id={{$menu->getRouteKey()}}'><i class="fa fa-plus-circle"></i> Sub Menu</button>
                @if($menu->id)
                <button type="button" class="btn btn-primary btn-sm" data-action="EDIT" data-load-to='#menu-entry' data-href='{{guard_url('menu/menu')}}/{{$menu->getRouteKey()}}/edit'><i class="fa fa-pencil-square"></i> {{ trans('app.edit') }}</button>
                <button type="button" class="btn btn-danger btn-sm" data-action="DELETE" href='{{guard_url('menu/menu')}}/{{$menu->getRouteKey()}}'><i class="fa fa-times-circle"></i> {{ trans('app.delete') }}</button>
                @endif
            </div>
        </ul>
        {!!Form::vertical_open()
        ->id('show-menu-show')
        ->method('PUT')
        ->action(guard_url('menu/menu'. $menu->getRouteKey()))!!}
        <div class="tab-content">
            @include('menu::admin.partial.menu')
        </div>
        {!!Form::close()!!}
    </div>
