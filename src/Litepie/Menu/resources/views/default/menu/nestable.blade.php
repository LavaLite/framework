<div class="dd nestable-menu" id="nestable">
    <ol class="dd-list">
        @forelse ($menus as $menu)
        @if ($children = $menu->getChildren())
        <li class="dd-item dd3-item" data-id="{!!$menu->getRouteKey()!!}">
            <div class="dd-handle dd3-handle"><i class="las la-arrows-alt"></i></div>
            <div class="dd3-content">
                <a href="#" class="app-submenu-edit" data-action="LOAD" data-load-to='#menu-entry'
                    data_val="{!!$menu->getRouteKey()!!}"
                    data-href='{{guard_url('menu/submenu')}}/{!!$menu->getRouteKey()!!}'>
                    <span><i class="{!! !empty($menu->icon) ?  $menu->icon : '' !!}"></i> {!!$menu->name!!}</span>
                </a>
            </div>
            <div class="actions">
                <a href="#" class="btn las la-pencil-alt app-submenu-edit" data-action="LOAD" data-load-to='#menu-entry'
                    data_val="{!!$menu->getRouteKey()!!}"
                    data-href='{{guard_url('menu/submenu')}}/{!!$menu->getRouteKey()!!}'></a>
                <a href="#" class="btn las la-trash" data-action='DELETE'
                data-load-to="#app-entry" data-list="#item-list"
                data-url="{{guard_url('menu/menu')}}/{!!$menu->getRouteKey()!!}"></a>
            </div>
            @include( 'menu::menu.sub.nestable', array('menus' => $children))
        </li>
        @else
        <li class="dd-item dd3-item" data-id="{!!$menu->getRouteKey()!!}">
            <div class="dd-handle dd3-handle"><i class="las la-arrows-alt"></i></div>
            <div class="dd3-content">
                <a href="#" class="app-submenu-edit" data-action="LOAD" data-load-to='#menu-entry'
                    data_val="{!!$menu->getRouteKey()!!}"
                    data-href='{{guard_url('menu/submenu')}}/{!!$menu->getRouteKey()!!}'>
                    <span><i class="{!! !empty($menu->icon) ?  $menu->icon : '' !!}"></i> {!!$menu->name!!}</span>
                </a>
            </div>
            <div class="actions">
                <a href="#" class="btn las la-pencil-alt app-submenu-edit" data-action="LOAD" data-load-to='#menu-entry'
                    data_val="{!!$menu->getRouteKey()!!}"
                    data-href='{{guard_url('menu/submenu')}}/{!!$menu->getRouteKey()!!}'></a>
                <a href="#" class="btn las la-trash" data-action='DELETE'
                data-load-to="#app-entry" data-list="#app-entry"
                data-url="{{guard_url('menu/menu')}}/{!!$menu->getRouteKey()!!}"></a>
            </div>
        </li>
        @endif
        @empty
        <li class="dd-item dd3-item">
            <div class="dd-handle dd3-handle"></div>
            <div class="dd3-content">
                <span> No menus added</span>
            </div>
        </li>

        @endif
    </ol>
</div>
<script>
$(document).ready(function() {
    $(".app-submenu-edit").click(function(e) {
        e.preventDefault();
        var id = $(this).attr('data_val');
        $("#app-entry").load('{{guard_url('menu/submenu')}}'+'/'+id+'/edit');
    });
});
</script>