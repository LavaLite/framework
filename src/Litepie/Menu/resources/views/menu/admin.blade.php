@foreach ($menus as $menu)
    @if($menu->has_role)
    @if ($menu->hasChildren())
        @include('menu::menu.sub.admin', array('menus' => $menu->getChildren()))
    @else
    <a class="nav-link {{ $menu->active ?? '' }}" href="{{trans_url($menu->url)}}" data-toggle="tooltip" data-placement="right" title="{{$menu->name}}">
        <i class="{{ $menu->icon ?? 'fa fa-angle-double-right' }}"></i>
    </a>
    @endif
    @endif
@endforeach