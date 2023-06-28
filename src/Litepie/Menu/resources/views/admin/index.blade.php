
    <div class="app-list-inner">
        <div class="app-list-header d-flex align-items-center justify-content-between">
            <h3>{{__('Menus')}}</h3>
            <button type="button" class="btn add-app-btn btn-icon btn-outline" data-action='CREATE'
                data-load-to="#app-entry" data-url="{{guard_url('menu/menu/create')}}">
                <i class="las la-plus"></i>
            </button>
        </div>

        <div class="app-list-wrap-inner" id="app-list">
            <div class="app-items perfect-scroll" data-url="{{guard_url('menu/menu')}}" id="item-list">
                @include('menu::admin.list', ['mode' => 'list'])
            </div>
        </div>
    </div>