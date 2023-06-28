<div class="app-entry-form-wrap">
    <div class="app-sec-title app-sec-title-with-icon app-sec-title-with-action">
        <i class="lab la-product-hunt app-sec-title-icon"></i>
        <h2> {!! trans('setting::setting.name') !!} <small> {!! trans('app.manage') !!} {!! trans('setting::setting.names') !!}</small></h2>
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
                data-url="{{guard_url('setting/0')}}">
                <i class="las la-window-close"></i>{{__('Cancel')}}
            </button>
        </div>
    </div>
    {!!Form::vertical_open()
    ->id('form-edit')
    ->method('POST')
    ->files('true')
    ->action(guard_url('setting/setting/main'))!!}
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="app-entry-form-section" id="basic">
                    <div class="section-title">{{trans('setting::setting.title.main')}} {!! trans('setting::setting.name') !!}</div>
                    <div class='row'>
                        <div class='col-md-12 col-sm-12'>
                            <div class="row">
                                <div class="col-md-8">
                                    {!! Form::text('env[APP_NAME]')
                                    -> label(trans('setting::setting.label.name'))
                                    -> value(env('APP_NAME'))
                                    -> placeholder(trans('setting::setting.placeholder.name'))!!}
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-4">
                                    {!! Form::select('settings[main.dateformat]')
                                    -> label(trans('setting::setting.label.dateformat'))
                                    -> options(trans('setting::setting.options.dateformat'),
                                    setting('main.dateformat'))
                                    -> placeholder(trans('setting::setting.placeholder.dateformat'))!!}
                                </div>

                                <div class="col-md-4">
                                    {!! Form::select('settings[main.timeformat]')
                                    -> label(trans('setting::setting.label.timeformat'))
                                    -> options(trans('setting::setting.options.timeformat'),
                                    setting('main.timeformat'))
                                    -> placeholder(trans('setting::setting.placeholder.timeformat'))!!}
                                </div>
                                <div class="col-md-4">
                                    {!! Form::select('settings[main.timezone]')
                                    -> label(trans('setting::setting.label.timezone'))
                                    -> options(DateTimeZone::listIdentifiers(DateTimeZone::ALL),
                                    setting('main.timezone'))
                                    -> placeholder(trans('setting::setting.placeholder.timezone'))!!}
                                </div>
                            </div>
                            <fieldset>
                                <legend>{{trans('setting::setting.label.currency.heading')}}</legend>
                                <div class="row clearfix">

                                    <div class="col-md-8">
                                        {!! Form::select('settings[main.currency.currency]')
                                        -> label(trans('setting::setting.label.currency.currency'))
                                        -> options(trans('setting::setting.options.currency.currency'),
                                        setting('main.currency.currency'))
                                        -> placeholder(trans('setting::setting.placeholder.currency.currency'))!!}
                                    </div>

                                    <div class="col-md-4">
                                        {!! Form::select('settings[main.currency.position]')
                                        -> label(trans('setting::setting.label.currency.position'))
                                        -> options(trans('setting::setting.options.currency.position'),
                                        setting('main.currency.position'))
                                        -> placeholder(trans('setting::setting.placeholder.currency.position'))!!}
                                    </div>

                                    <div class="col-md-4">
                                        {!! Form::text('settings[main.currency.thousandseperator]')
                                        -> label(trans('setting::setting.label.currency.thousandseperator'))
                                        -> value(setting('main.currency.thousandseperator'))
                                        ->
                                        placeholder(trans('setting::setting.placeholder.currency.thousandseperator'))!!}
                                    </div>

                                    <div class="col-md-4">
                                        {!! Form::text('settings[main.currency.decimalseperator]')
                                        -> label(trans('setting::setting.label.currency.decimalseperator'))
                                        -> value(setting('main.currency.decimalseperator'))
                                        ->
                                        placeholder(trans('setting::setting.placeholder.currency.decimalseperator'))!!}
                                    </div>

                                    <div class="col-md-4">
                                        {!! Form::text('settings[main.currency.decimal]')
                                        -> label(trans('setting::setting.label.currency.decimal'))
                                        -> value(setting('main.currency.decimal'))
                                        -> placeholder(trans('setting::setting.placeholder.currency.decimal'))!!}
                                    </div>

                                </div>
                            </fieldset>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>