<ul class="nav">
@foreach ($menus as $menu)
        <a href="{{$menu->url}}">
        <i class="{{$menu->icon}}"> </i>
        </a>
@endforeach
</ul>
