<ol class="dd-list">
    @foreach ($menus as $menu)
    @if ($children = $menu->getChildren())
    <li class="dd-item dd3-item" data-id="{!!$menu['eid']!!}">
        <div class="dd-handle dd3-handle"><i class="las la-arrows-alt"></i></div>
        <div class="dd3-content">
            <a href="#" class="app-submenu-edit" data-action="LOAD" data-load-to='#sub-menu-edit'
                data_val="{!!$menu['eid']!!}"
                data-href="{{guard_url('menu/submenu')}}/{!!$menu['eid']!!}">
                <span><i class="{!! !empty($menu->icon) ?  $menu->icon : '' !!}"></i> {!!$menu->name!!}</span>
            </a>
        </div>
        <div class="actions">
            <a href="#" class="btn las la-pencil-alt app-submenu-edit" data-action="LOAD" data-load-to='#sub-menu-edit'
                data_val="{!!$menu['eid']!!}"
                data-href="{{guard_url('menu/submenu')}}/{!!$menu['eid']!!}"></a>
            <a href="#" class="btn las la-trash" data-action='DELETE' data-load-to="#app-entry" data-list="#app-entry"
                data-url="{{guard_url('menu/menu')}}/{!!$menu['eid']!!}"></a>
        </div>
        <ol class="dd-list">
            @include( 'menu::admin.menu.sub.nestable', array('menus' => $children))
        </ol>
        @else
    <li class="dd-item dd3-item" data-id="{!!$menu['eid']!!}">
        <div class="dd-handle dd3-handle"><i class="las la-arrows-alt"></i></div>
        <div class="dd3-content">
            <a href='' class="app-submenu-edit" data_val="{!!$menu['eid']!!}"
                data-href="{{guard_url('menu/submenu')}}/{!!$menu['eid']!!}" data-action="LOAD"
                data-load-to='#sub-menu-edit'>
                <span><i class="{!! !empty($menu->icon) ?  $menu->icon : '' !!}"></i> {!!$menu->name!!}</span>

            </a>
        </div>
        <div class="actions">
            <a href="#" class="btn las la-pencil-alt app-submenu-edit" data-action="LOAD" data-load-to='#sub-menu-edit'
                data_val="{!!$menu['eid']!!}"
                data-href='{{guard_url("menu/submenu")}}/{!!$menu['eid']!!}'></a>
            <a href="#" class="btn las la-trash" data-action='DELETE' data-load-to="#app-entry" data-list="#app-entry"
                data-url="{{guard_url('menu/menu')}}/{!!$menu['eid']!!}"></a>
        </div>
    </li>
    @endif
    @endforeach
</ol>
<script>
$(document).ready(function() {
    $(".app-submenu-edit").click(function(e) {
        e.preventDefault();
        var id = $(this).attr('data_val');
        $("#app-content").load("{{guard_url('menu/submenu')}}'+'/'+id+'/edit");
    });
});
</script>