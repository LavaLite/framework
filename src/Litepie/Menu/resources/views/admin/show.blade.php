@if($menu->key == null)
@include('menu::admin.new')
@else
<div class="app-entry-form-wrap">
    <div class="app-sec-title app-sec-title-with-icon app-sec-title-with-action">
        <i class="lab la-product-hunt app-sec-title-icon"></i>

        <h2>{!!$menu->name!!} </h2>

        <div class="actions">
            <button type="button" class="btn btn-success btn-sm app-submenu-create" data_val="{{$menu['eid']}}"
                data-action="NEW" data-load-to='#app-entry'><i class="fa fa-plus-circle"></i> Sub Menu</button>

        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div id="item-menu-list" data-url="{!! guard_url('menu/menu/'.$menu['eid']) !!}">
                    {!!Menu::menu($menu->key, 'menu::admin.menu.nestable')!!}
                </div>
            </div>
            <div class="col-md-6" id="sub-menu-edit" data-url="{!! guard_url('menu/menu/'.$menu['eid']) !!}">
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
        $("#sub-menu-edit").load("{{guard_url('menu/submenu/create?parent_id=')}}" + id);
    });

    var updateMenu = function(e) {
        var out = $(e.target).nestable('serialize');
        out = JSON.stringify(out);

        var formData = new FormData();
        formData.append('tree', out);
        formData.append('parent_id', '{{$menu['eid']}}');

        var url = "{!! guard_url('menu/menu/'.$menu['eid'].'/tree') !!}";

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

.dd {
    position: relative;
    display: block;
    margin: 0;
    padding: 0;
    list-style: none;
    font-size: 13px;
    line-height: 20px;
}

.dd-list {
    display: block;
    position: relative;
    margin: 0;
    padding: 0;
    list-style: none;
}

.dd-list .dd-list {
    padding-left: 30px;
}

.dd-collapsed .dd-list {
    display: none;
}

.dd-item,
.dd-empty,
.dd-placeholder {
    display: block;
    position: relative;
    margin: 0;
    padding: 0;
    min-height: 20px;
    font-size: 13px;
    line-height: 20px;
}

.dd-handle {
    cursor: default;
    display: block;
    margin: 5px 0;
    padding: 7px 10px;
    color: #333;
    text-decoration: none;
    border: 1px solid #ddd;
    background: #fff;
}

.dd-handle:hover {
    color: #FFF;
    background: #4D90FD;
    border-color: #f39c12;
}

.dd-item>button {
    color: #555;
    font-family: FontAwesome;
    display: block;
    position: relative;
    cursor: pointer;
    float: left;
    width: 25px;
    height: 20px;
    margin: 8px 0px;
    padding: 0;
    text-indent: 100%;
    white-space: nowrap;
    overflow: hidden;
    border: 0;
    background: transparent;
    font-size: 10px;
    line-height: 1;
    text-align: center;
}

.dd-item>button:before {
    display: block;
    position: absolute;
    width: 100%;
    text-align: center;
    text-indent: 0;
}
.dd-item {
    padding: 0px 0px;
}

.dd-item>button[data-action="collapse"]:before {}

.dd-placeholder,
.dd-empty {
    margin: 5px 0;
    padding: 0;
    min-height: 30px;
    background: #FFF;
    border: 1px dashed #b6bcbf;
    box-sizing: border-box;
    -moz-box-sizing: border-box;
}

.dd-empty {
    border: 1px dashed #bbb;
    min-height: 100px;
    background-color: #e5e5e5;
    background-image: -webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
        -webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
    background-image: -moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
        -moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
    background-image: linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
        linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
    background-size: 60px 60px;
    background-position: 0 0, 30px 30px;
}

.dd-dragel {
    position: absolute;
    pointer-events: none;
    z-index: 9999;
}

.dd-dragel>.dd-item .dd-handle {
    margin-top: 0;
}

.dd-dragel .dd-handle {
    -webkit-box-shadow: 2px 4px 6px 0 rgba(0, 0, 0, .1);
    box-shadow: 2px 4px 6px 0 rgba(0, 0, 0, .1);
}

.dd3-content {
    display: block;
    margin: 5px 0;
    padding: 7px 10px 7px 40px;
    color: #333;
    text-decoration: none;
    background: none repeat scroll 0 0 #FFFFFF;
    border: 1px solid #DDDDDD;
    color: #333333;
}

.dd3-content:hover {
    background: #fff;
}

.dd3-content a {
    color: #F39C12;
}

.dd-dragel>.dd3-item>.dd3-content {
    margin: 0;
}

.dd3-handle {
    position: absolute;
    margin: 0;
    left: 0;
    top: 0;
    cursor: all-scroll;
    width: 34px;
    /* text-indent: 100%; */
    white-space: nowrap;
    overflow: hidden;
    border: 1px solid #f39c12;
    background: #f39c12;
    height: 36px;
    box-shadow: 1px 1px 0 rgba(255, 255, 255, 0.2) inset;
}


.dd3-handle:hover {
    background: #f39c12;
}
</style>