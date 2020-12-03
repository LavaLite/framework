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
                data-url="{{guard_url('settings')}}">
                <i class="las la-window-close"></i>{{__('Cancel')}}
            </button>
        </div>
    </div>
    {!!Form::vertical_open()
    ->id('form-edit')
    ->method('POST')
    ->files('true')
    ->action(guard_url('settings/company'))!!}
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="app-entry-form-section" id="basic">
                    <div class="section-title">{!! trans('settings::setting.names') !!}</div>
                    <div class='row'>
                        <div class='col-md-12 col-sm-12'>
                            <div class='row'>
                                <div class='col-md-12 col-sm-12'>
                                    {!! Form::text('settings[main.company.name]')
                                    -> label(trans('settings::setting.label.company.name'))
                                    -> value(setting('main.company.name'))
                                    -> placeholder(trans('settings::setting.placeholder.company.name'))!!}
                                    <div class="row clearfix">
                                        <div class="col-md-6">
                                            {!! Form::email('settings[main.company.email]')
                                            -> label(trans('settings::setting.label.company.email'))
                                            -> value(setting('main.company.email'))
                                            -> placeholder(trans('settings::setting.placeholder.company.email'))!!}
                                        </div>
                                        <div class="col-md-6">
                                            {!! Form::text('settings[main.company.phone]')
                                            -> label(trans('settings::setting.label.company.phone'))
                                            -> value(setting('main.company.phone'))
                                            -> placeholder(trans('settings::setting.placeholder.company.phone'))!!}
                                        </div>
                                    </div>
                                    {!! Form::file('upload[main.logo.normal][file]')
                                    -> label(trans('settings::setting.label.company.logo'))
                                    -> placeholder(trans('settings::setting.placeholder.company.logo'))!!}

                                    {!! Form::hidden('upload[main.logo.normal][path]')
                                    -> value(public_path('assets/img/'))!!}

                                    {!! Form::file('upload[main.logo.big][file]')
                                    -> label(trans('settings::setting.label.company.logo_big'))
                                    -> placeholder(trans('settings::setting.placeholder.company.logo_big'))!!}

                                    {!! Form::hidden('upload[main.logo.big][path]')
                                    -> value(public_path('assets/img/'))!!}

                                    {!! Form::textarea('settings[main.company.address]')
                                    -> label(trans('settings::setting.label.company.address'))
                                    -> value(setting('main.company.address'))
                                    -> placeholder(trans('settings::setting.placeholder.company.address'))!!}

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