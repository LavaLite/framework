<div class="box-header with-border">
    <h3 class="box-title"> {{ trans('cms.view') }} menu [{{$menu->name or 'New menu'}}]</h3>
    <div class="box-tools pull-right">
        <button type="button" class="btn btn-success btn-sm" data-action="NEW" data-load-to='#menu-entry' data-href='{{trans_url('admin/menu/submenu/create')}}?parent_id={{$menu->getRouteKey()}}'><i class="fa fa-plus-circle"></i> Sub Menu</button>
        @if($menu->id)
        <button type="button" class="btn btn-primary btn-sm" data-action="EDIT" data-load-to='#menu-entry' data-href='{{trans_url('admin/menu/menu')}}/{{$menu->getRouteKey()}}/edit'><i class="fa fa-pencil-square"></i> {{ trans('cms.edit') }}</button>
        <button type="button" class="btn btn-danger btn-sm" data-action="DELETE" href='{{trans_url('admin/menu/menu')}}/{{$menu->getRouteKey()}}'><i class="fa fa-times-circle"></i> {{ trans('cms.delete') }}</button>
        @endif
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
        ->id('show-menu-show')
        ->method('PUT')
        ->action(trans_url('admin/menu/menu'. $menu->getRouteKey()))!!}
        <div class="tab-content">
            @include('Menu::partial.menu')
        </div>
        {!!Form::close()!!}
    </div>
</div>
<div class="box-footer" >
</div>
