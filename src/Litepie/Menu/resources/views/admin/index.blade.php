<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-bars"></i>
        {!! trans('menu::menu.name') !!}
        <small> {!! trans('app.manage') !!} {!! trans('menu::menu.names') !!}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{!! guard_url('admin') !!}"><i class="fa fa-dashboard"></i> {!! trans('app.home') !!} </a></li>
            <li class="active">{!! trans('menu::menu.names') !!}</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class='row' style="min-height:700px;">
            <div class="col-md-5">
                <div class="nav-tabs-custom">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs primary">
                        @foreach($rootMenu->take(3) as $menu)
                        <li {{($parent->getRouteKey() == $menu->getRouteKey()) ? ' class=active ' : ''}}><a href="{{ guard_url('menu/menu') }}/{{$menu->getRouteKey()}}">{{$menu->name}}</a></li>
                        @endforeach
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                              More <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                            @foreach($rootMenu->except([1,2,3]) as $menu)
                              <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ guard_url('menu/menu') }}/{{$menu->getRouteKey()}}">{{$menu->name}} menu</a></li>
                            @endforeach
                            </ul>
                        </li>
                        <li class="pull-right"><a href="#" data-href="{{ guard_url('menu/menu/create') }}"  data-action="LOAD" data-load-to="#menu-entry"><i class="fa fa-plus-circle"></i></a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="details">
                            {!!Menu::menu($parent->key, 'menu::admin.menu.nestable')!!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div id='menu-entry'>
                </div>
            </div>
        </div>
    </section>
</div>





<script type="text/javascript">
$(document).ready(function(){

    var updateMenu = function(e)
    {
        var out = $(e.target).nestable('serialize');
        out     = JSON.stringify(out);

        var formData = new FormData();
        formData.append('tree', out);

        var url  = '{!! guard_url('menu/menu/'. $parent->getRouteKey() . '/tree') !!}';

        $.ajax( {
            url: url,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success:function (data, textStatus, jqXHR)
            {
                console.log(data);
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
            }
        });
    };

    $('.dd').nestable().on('change', updateMenu);


    $('#menu-entry').load('{{guard_url('menu/menu')}}/{{$parent->getRouteKey()}}');


});
</script>

<style type="text/css">
.box-body{
    min-height: 420px;
}
</style>