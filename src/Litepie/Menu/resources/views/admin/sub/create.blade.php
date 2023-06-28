<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="app-entry-form-section" id="details">
                <div class="section-title">
                    [{{$menu['name'] ?? 'New menu'}}]
                    <div class="actions float-right">
                        <button type="button" class="btn btn-with-icon btn-link app-create btn-outline"
                            data-action='STORE' 
                            data-form="#form-create" 
                            data-load-to="#sub-menu-edit"
                            data-list="#item-menu-list">
                            <i class="las la-save"></i>{{__('Create')}}
                        </button>
                    </div>
                </div>
                {!!Form::vertical_open()
                ->id('form-create')
                ->method('POST')
                ->files('true')
                ->action(guard_url('menu/submenu'))!!}
                @include('menu::admin.partial.submenu', ['mode' => 'create'])
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>