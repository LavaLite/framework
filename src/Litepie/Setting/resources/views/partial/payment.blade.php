<div class="app-entry-form-wrap">
    <div class="app-sec-title app-sec-title-with-icon app-sec-title-with-action">
        <i class="lab la-product-hunt app-sec-title-icon"></i>
        <h2> {!! trans('setting::setting.name') !!} <small> {!! trans('app.manage') !!} {!!
                trans('setting::setting.names') !!}</small></h2>
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
    ->action(guard_url('setting/setting/payment'))!!}
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="app-entry-form-section" id="basic">
                    <div class="section-title">{{trans('setting::setting.title.payment')}} {!! trans('setting::setting.name') !!}</div>
                    <div class='row'>
                        <div class='col-md-12 col-sm-12'>
                            <div class='row'>
                                <div class='col-md-12 col-sm-12'>
                                    <fieldset>
                                        <legend>{{trans('setting::setting.label.payment.paypal')}}</legend>
                                        <div class="row">
                                            <div class="col-md-12">
                                                {!! Form::text('env[PAYPAL_CLIENT_ID]')
                                                -> label(trans('setting::setting.label.payment.paypal_client_id'))
                                                -> value(env('PAYPAL_CLIENT_ID'))
                                                ->
                                                placeholder(trans('setting::setting.placeholder.payment.paypal_client_id'))!!}
                                            </div>
                                            <div class="col-md-12">
                                                {!! Form::text('env[PAYPAL_SECRET]')
                                                -> label(trans('setting::setting.label.payment.paypal_client_secret'))
                                                -> value(env('PAYPAL_SECRET'))
                                                ->
                                                placeholder(trans('setting::setting.placeholder.payment.paypal_client_secret'))!!}
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