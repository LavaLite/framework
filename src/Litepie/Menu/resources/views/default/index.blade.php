<div class="app-list-wrap">
    <div class="app-list-inner">
        <div class="app-list-header d-flex align-items-center justify-content-between">
            <h3>{{__('Menus')}}</h3>
            <button type="button" class="btn add-app-btn btn-icon btn-outline" data-action='CREATE'
                data-load-to="#app-entry" data-url="{{guard_url('menu/menu/create')}}">
                <i class="las la-plus"></i>
            </button>
        </div>

        <div class="app-list-wrap-inner ps ps--active-y" id="app-list">
            <div class="app-items" data-url="{{guard_url('menu/menu')}}" id="item-list">
                @include('menu::more', ['mode' => 'list'])
            </div>
        </div>
    </div>
    <div class="app-detail-wrap" id="app-entry">
    </div>
</div>
<script type="">
    var module_link = "{{guard_url('menu/menu')}}";
</script>