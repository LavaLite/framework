<div class="app-entry-form-wrap">
    <div class="app-sec-title app-sec-title-with-icon app-sec-title-with-action">
        <i class="lab la-product-hunt app-sec-title-icon"></i>
        <h2>{{__('Create')}} {{ trans('menu::menu.name') }}</h2>
        <div class="actions">
            <button type="button" class="btn btn-with-icon btn-link app-create btn-outline" data-action='STORE'
                data-form="#form-create" data-load-to="#app-entry" data-list="#item-list">
                <i class="las la-save"></i>{{__('Create')}}
            </button>
           
        </div>
    </div>
    {!!Form::vertical_open()
    ->id('form-create')
    ->method('POST')
    ->files('true')
    ->action(guard_url('menu/submenu'))!!}
    {!!Form::token()!!}
    @include('menu::partial.submenu', ['mode' => 'create'])

    {!! Form::close() !!}
</div>