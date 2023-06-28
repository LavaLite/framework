<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="app-entry-form-section" id="details">
                <div class="section-title">
                    [{{$menu['name'] ?? 'New Menu'}}]
                    <div class="actions float-right">
                        <button type="button" class="btn btn-with-icon btn-link  btn-outline" data-action='EDIT'
                            data-load-to="#sub-menu-edit"
                            data-url="{{guard_url('menu/submenu')}}/{!!$menu['eid']!!}/edit"><i
                                class="las la-save"></i>{{__('Edit')}}</button>
                        <button type="button" class="btn btn-with-icon btn-link  btn-outline" data-action='DELETE'
                            data-load-to="#sub-menu-edit" data-list="#item-menu-list"
                            data-url="{{guard_url('menu/menu')}}/{!!$menu['eid']!!}"><i
                                class="las la-trash"></i>{{__('Delete')}}</button>
                    </div>
                </div>
                {!!Form::vertical_open()
                ->id('app-form-show')
                ->class('app-form-show')
                ->method('PUT')
                ->action(guard_url('menu/submenu/'. $menu['eid']))!!}

                @include('menu::admin.partial.submenu', ['mode' => 'show'])

                {!!Form::close()!!}
            </div>
        </div>
    </div>
</div>