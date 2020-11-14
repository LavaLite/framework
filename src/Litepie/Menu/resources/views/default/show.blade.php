@if($menu->key==null)
@include('menu::new')
@else
<div class="app-entry-form-wrap">
    <div class="app-sec-title app-sec-title-with-icon app-sec-title-with-action">
        <i class="lab la-product-hunt app-sec-title-icon"></i>
        <h2>{{__('Show')}} {!!$menu->name!!}</h2>
        <div class="actions">
            <button type="button" class="btn btn-success btn-sm app-submenu-create" data_val="{{$menu->getRouteKey()}}"
                data-action="NEW" data-load-to='#app-entry'
              ><i
                    class="fa fa-plus-circle"></i> Sub Menu</button>
           
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="col-md-6">
                    {!!Menu::menu($menu->key, 'menu::menu.nestable')!!}
                </div>   
            </div>
        </div>
    </div>
</div>
@endif
<script>
$(document).ready(function() {
    $(".app-submenu-create").click(function(e) {
        e.preventDefault();
        var id = $(this).attr('data_val');
        $("#app-entry").load('{{guard_url('menu/submenu/create?parent_id=')}}'+id);
    });
});
</script>
<script type="text/javascript">
$(document).ready(function() {

    var updateMenu = function(e) {
        var out = $(e.target).nestable('serialize');
        out = JSON.stringify(out);

        var formData = new FormData();
        formData.append('tree', out);

        var url = '{!! guard_url('menu/menu/'.$menu->getRouteKey().'/tree') !!}';

        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data, textStatus, jqXHR) {
                console.log(data);
            },
            error: function(jqXHR, textStatus, errorThrown) {}
        });
    };

    $('.dd').nestable().on('change', updateMenu);

});
</script>
<style type="text/css">
.box-body {
    min-height: 420px;
}
</style>