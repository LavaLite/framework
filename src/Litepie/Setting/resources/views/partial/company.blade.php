<div class="app-entry-form-wrap">
    <div class="app-sec-title app-sec-title-with-icon app-sec-title-with-action">
        <i class="lab la-product-hunt app-sec-title-icon"></i>
        <h2> {!! trans('setting::setting.name') !!} <small> {!! trans('app.manage') !!} {!!
                trans('setting::setting.names') !!}</small></h2>
        <div class="actions">
            <button type="button" class="btn btn-with-icon btn-link  btn-outline" data-action='UPDATE'
                data-form="#form-edit" data-load-to="#app-entry">
                <i class="las la-save"></i>{{__('Save')}}
            </button>
            <button type="button" class="btn btn-with-icon btn-link  btn-outline" data-action='SHOW'
                data-load-to="#app-entry" data-url="{{guard_url('settings')}}">
                <i class="las la-window-close"></i>{{__('Cancel')}}
            </button>
        </div>
    </div>
    {!!Form::vertical_open()
    ->id('form-edit')
    ->method('POST')
    ->files('true')
    ->action(guard_url('setting/setting/company'))!!}
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="app-entry-form-section" id="basic">
                    <div class="section-title">{{trans('setting::setting.title.company')}} {!! trans('setting::setting.name') !!}</div>
                    <div class='row'>
                        <div class='col-md-12 col-sm-12'>
                            <div class='row'>
                                <div class='col-md-12 col-sm-12'>
                                    {!! Form::text('settings[main.company.name]')
                                    -> label(trans('setting::setting.label.company.name'))
                                    -> value(setting('main.company.name'))
                                    -> placeholder(trans('setting::setting.placeholder.company.name'))!!}
                                    <div class="row clearfix">
                                        <div class="col-md-6">
                                            {!! Form::email('settings[main.company.email]')
                                            -> label(trans('setting::setting.label.company.email'))
                                            -> value(setting('main.company.email'))
                                            -> placeholder(trans('setting::setting.placeholder.company.email'))!!}
                                        </div>
                                        <div class="col-md-6">
                                            {!! Form::text('settings[main.company.phone]')
                                            -> label(trans('setting::setting.label.company.phone'))
                                            -> value(setting('main.company.phone'))
                                            -> placeholder(trans('setting::setting.placeholder.company.phone'))!!}
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-md-6">
                                            {!! Form::file('upload[main.logo.normal][file]')
                                            -> label(trans('setting::setting.label.company.logo'))
                                            ->url('upload/file')
                                            -> placeholder(trans('setting::setting.placeholder.company.logo'))!!}

                                            {!! Form::hidden('upload[main.logo.normal][path]')
                                            -> value(public_path('assets/img/'))!!}
                                        </div>
                                        <div class="col-md-6">
                                            {!! Form::file('upload[main.logo.big][file]')
                                            -> label(trans('setting::setting.label.company.logo_big'))
                                            ->url('upload/file')
                                            -> placeholder(trans('setting::setting.placeholder.company.logo_big'))!!}

                                            {!! Form::hidden('upload[main.logo.big][path]')
                                            -> value(public_path('assets/img/'))!!}
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-md-6">
                                            {!! Form::textarea('settings[main.company.address]')
                                            -> label(trans('setting::setting.label.company.address'))
                                            -> value(setting('main.company.address'))
                                            -> placeholder(trans('setting::setting.placeholder.company.address'))!!}
                                        </div>
                                        <div class="col-md-6">
                                            {!! Form::text('settings[main.company.city]')
                                            -> label(trans('setting::setting.label.company.city'))
                                            -> value(setting('main.company.city'))
                                            -> placeholder(trans('setting::setting.placeholder.company.city'))!!}

                                            {!! Form::text('settings[main.company.state]')
                                            -> label(trans('setting::setting.label.company.state'))
                                            -> value(setting('main.company.state'))
                                            -> placeholder(trans('setting::setting.placeholder.company.state'))!!}

                                            {!! Form::text('settings[main.company.country]')
                                            -> label(trans('setting::setting.label.company.country'))
                                            -> value(setting('main.company.country'))
                                            -> placeholder(trans('setting::setting.placeholder.company.country'))!!}
                                        </div>
                                    </div>
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
