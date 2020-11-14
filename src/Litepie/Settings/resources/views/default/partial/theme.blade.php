<div class="app-entry-form-wrap">
    <div class="app-sec-title app-sec-title-with-icon app-sec-title-with-action">
        <i class="lab la-product-hunt app-sec-title-icon"></i>
        <h2> {!! trans('settings::setting.name') !!} <small> {!! trans('app.manage') !!} {!!
                trans('settings::setting.names') !!}</small></h2>
        <div class="actions">
            <button type="button" class="btn btn-with-icon btn-link  btn-outline" 
                data-action='UPDATE'
                data-form="#form-edit" 
                data-load-to="#app-entry" >
                <i class="las la-save"></i>{{__('Save')}}
            </button>
            <button type="button" class="btn btn-with-icon btn-link  btn-outline"
                data-action='SHOW'
                data-load-to="#app-entry" 
                data-url="{{guard_url('settings/0')}}">
                <i class="las la-window-close"></i>{{__('Cancel')}}
            </button>
        </div>
    </div>
    {!!Form::vertical_open()
    ->id('form-edit')
    ->method('POST')
    ->files('true')
    ->action(guard_url('settings/theme'))!!}
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="app-entry-form-section" id="basic">
                    <div class="section-title">{!! trans('settings::setting.names') !!}</div>
                    <div class='row'>
                        <div class='col-md-12 col-sm-12'>
                            <div class='row'>
                                <div class='col-md-12 col-sm-12'>
                                    <fieldset>
                                        <legend>{{trans('settings::setting.label.theme.admin.name')}}</legend>
                                        <div class="row">

                                            <div class="col-md-4">
                                                {!! Form::select('settings[main.admin.color]')
                                                -> label(trans('settings::setting.label.theme.admin.color'))
                                                -> options(__('settings::setting.options.theme'),
                                                setting('main.admin.color'))!!}
                                            </div>
                                            <div class="col-md-4">
                                                {!! Form::file('upload[theme.admin.logo.logo][file]')
                                                -> label(trans('settings::setting.label.theme.admin.logo.logo'))
                                                ->
                                                placeholder(trans('settings::setting.placeholder.theme.admin.logo.logo'))!!}
                                                {!! Form::hidden('upload[theme.admin.logo.logo][path]')
                                                -> value(public_path('themes/admin/assets/img/logo/'))!!}
                                            </div>
                                            <div class="col-md-4">
                                                {!! Form::file('upload[theme.admin.logo.white][file]')
                                                -> label(trans('settings::setting.label.theme.admin.logo.white'))
                                                ->
                                                placeholder(trans('settings::setting.placeholder.theme.admin.logo.white'))!!}
                                                {!! Form::hidden('upload[theme.admin.logo.white][path]')
                                                -> value(public_path('themes/admin/assets/img/logo/'))!!}
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset>
                                        <legend>{{trans('settings::setting.label.theme.user.name')}}</legend>
                                        <div class="row">
                                            <div class="col-md-4">
                                                {!! Form::select('settings[main.user.color]')
                                                -> label(trans('settings::setting.label.theme.user.color'))
                                                -> options(__('settings::setting.options.theme'),
                                                setting('main.user.color'))!!}
                                            </div>
                                            <div class="col-md-4">
                                                {!! Form::file('upload[theme.user.logo.logo][file]')
                                                -> label(trans('settings::setting.label.theme.user.logo.logo'))
                                                ->
                                                placeholder(trans('settings::setting.placeholder.theme.user.logo.logo'))!!}
                                                {!! Form::hidden('upload[theme.user.logo.logo][path]')
                                                -> value(public_path('themes/user/assets/img/logo/'))!!}
                                            </div>
                                            <div class="col-md-4">
                                                {!! Form::file('upload[theme.user.logo.white][file]')
                                                -> label(trans('settings::setting.label.theme.user.logo.white'))
                                                ->
                                                placeholder(trans('settings::setting.placeholder.theme.user.logo.white'))!!}
                                                {!! Form::hidden('upload[theme.user.logo.white][path]')
                                                -> value(public_path('themes/user/assets/img/logo/'))!!}
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset>
                                        <legend>{{trans('settings::setting.label.theme.public.name')}}</legend>
                                        <div class="row">

                                            <div class="col-md-4">
                                                {!! Form::select('settings[main.public.color]')
                                                -> label(trans('settings::setting.label.theme.public.color'))
                                                -> options(__('settings::setting.options.theme'),
                                                setting('main.public.color'))!!}
                                            </div>
                                            <div class="col-md-4">
                                                {!! Form::file('upload[theme.public.logo.logo][file]')
                                                -> label(trans('settings::setting.label.theme.public.logo.logo'))
                                                ->
                                                placeholder(trans('settings::setting.placeholder.theme.public.logo.logo'))!!}
                                                {!! Form::hidden('upload[theme.public.logo.logo][path]')
                                                -> value(public_path('themes/public/assets/img/logo/'))!!}
                                            </div>
                                            <div class="col-md-4">
                                                {!! Form::file('upload[theme.public.logo.white][file]')
                                                -> label(trans('settings::setting.label.theme.public.logo.white'))
                                                ->
                                                placeholder(trans('settings::setting.placeholder.theme.public.logo.white'))!!}
                                                {!! Form::hidden('upload[theme.public.logo.white][path]')
                                                -> value(public_path('themes/public/assets/img/logo/'))!!}
                                            </div>
                                        </div>
                                    </fieldset>


                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>