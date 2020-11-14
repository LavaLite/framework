<div class="app-entry-form-wrap">
    <div class="app-sec-title app-sec-title-with-icon app-sec-title-with-action">
        <i class="lab la-product-hunt app-sec-title-icon"></i>
        <h2>{{__('Edit')}} {!!$menu->name!!}</h2>
        <div class="actions">
            <button type="button" class="btn btn-with-icon btn-link  btn-outline" data-action='UPDATE'
                data-form="#form-edit" data-load-to="#app-entry" data-list="#item-list">
                <i class="las la-save"></i>{{__('Save')}}
            </button>
            <button type="button" class="btn btn-with-icon btn-link  btn-outline" data-action='SHOW'
                data-load-to="#app-entry" data-url="{{guard_url('menu/menu')}}/{!!$menu->getRouteKey()!!}">
                <i class="las la-window-close"></i>{{__('Cancel')}}
            </button>
            <button type="button" class="btn btn-with-icon btn-link  btn-outline" data-action='DELETE'
                data-load-to="#app-entry" data-list="#item-list"
                data-url="{{guard_url('menu/menu')}}/{!!$menu->getRouteKey()!!}"><i
                    class="las la-trash"></i>{{__('Delete')}}</button>
        </div>
    </div>

    {!!Form::vertical_open()
    ->method('PUT')
    ->id('form-edit')
    ->enctype('multipart/form-menu')
    ->action(guard_url('menu/menu/'. $menu->getRouteKey()))!!}
    {!!Form::token()!!}
    {!!Form::hidden('upload_folder')!!}

    @include('menu::partial.menu', ['mode' => 'edit'])

    {!!Form::close()!!}
</div>
<script>
$(document).ready(function() {
    $(".app-submenu-create").click(function(e) {
        e.preventDefault();
        var id = $(this).attr('data_val');
        $("#app-content").load('{{guard_url('
            menu / submenu / create ? parent_id = ')}}' + id);
    });
});
</script>