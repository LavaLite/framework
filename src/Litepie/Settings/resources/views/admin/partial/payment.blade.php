              {!!Form::vertical_open()
              ->id('settings-setting-create')
              ->method('POST')
              ->files('true')
              ->action(guard_url('settings/payment'))!!}
              <div class='row'>
                  <div class='col-md-12 col-sm-12'>
                      <fieldset>
                        <legend>{{trans('settings::setting.label.payment.paypal')}}</legend>
                          <div class="row">
                              <div class="col-md-12">
                                  {!! Form::text('env[PAYPAL_CLIENT_ID]')
                                  -> label(trans('settings::setting.label.payment.paypal_client_id'))
                                  -> value(env('PAYPAL_CLIENT_ID'))
                                  ->
                                  placeholder(trans('settings::setting.placeholder.payment.paypal_client_id'))!!}
                              </div>
                              <div class="col-md-12">
                                  {!! Form::text('env[PAYPAL_SECRET]')
                                  -> label(trans('settings::setting.label.payment.paypal_client_secret'))
                                  -> value(env('PAYPAL_SECRET'))
                                  placeholder(trans('settings::setting.placeholder.payment.paypal_client_secret'))!!}
                              </div>
                          </div>
                      </fieldset>
                  </div>
              </div>
              {!! Form::close() !!}
