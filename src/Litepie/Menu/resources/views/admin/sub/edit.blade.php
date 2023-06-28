<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="app-entry-form-section" id="details">
                <div class="section-title">
                    [{{$menu->name ?? 'New menu'}}]
                    <div class="actions float-right">
                        <button type="button" class="btn btn-with-icon btn-link  btn-outline"
                            data-action='UPDATE'
                            data-form="#form-edit"
                            data-load-to="#sub-menu-edit">
                            <i class="las la-save"></i>{{__('Save')}}
                        </button>
                        <button type="button" class="btn btn-with-icon btn-link  btn-outline" 
                            data-action='SHOW'
                            data-load-to="#sub-menu-edit"
                            data-url="{{guard_url('menu/submenu')}}/{!!$menu['eid']!!}">
                            <i class="las la-window-close"></i>{{__('Cancel')}}
                        </button>
                    </div>
                </div>
                {!!Form::vertical_open()
                ->method('PUT')
                ->id('form-edit')
                ->enctype('multipart/form-menu')
                ->action(guard_url('menu/submenu/'. $menu['eid']))!!}

                @include('menu::admin.partial.submenu', ['mode' => 'edit'])

                {!!Form::close()!!}
            </div>
        </div>
    </div>
</div>
