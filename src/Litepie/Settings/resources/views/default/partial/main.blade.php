              {!!Form::vertical_open()
              ->id('settings-setting-create')
              ->method('POST')
              ->files('true')
              ->action(trans_url('settings/main'))!!}
              <div class='row'>
                  <div class='col-md-12 col-sm-12'>
                      <div class="row">
                          <div class="col-md-4">
                              {!! Form::select('settings[user.dateformat]')
                              -> label(trans('settings::setting.label.dateformat'))
                              -> options(trans('settings::setting.options.dateformat'), setting('dateformat'))
                              -> placeholder(trans('settings::setting.placeholder.dateformat'))!!}
                          </div>

                          <div class="col-md-4">
                              {!! Form::select('settings[user.timeformat]')
                              -> label(trans('settings::setting.label.timeformat'))
                              -> options(trans('settings::setting.options.timeformat'), setting('timeformat'))
                              -> placeholder(trans('settings::setting.placeholder.timeformat'))!!}
                          </div>
                          <div class="col-md-4">
                              {!! Form::select('settings[user.timezone]')
                              -> label(trans('settings::setting.label.timezone'))
                              -> options(DateTimeZone::listIdentifiers(DateTimeZone::ALL), setting('timezone'))
                              -> placeholder(trans('settings::setting.placeholder.timezone'))!!}
                          </div>
                      </div>
                      <fieldset>
                          <legend>{{trans('settings::setting.label.currency.heading')}}</legend>
                          <div class="row clearfix">

                              <div class="col-md-8">
                                  {!! Form::select('settings[user.currency.currency]')
                                  -> label(trans('settings::setting.label.currency.currency'))
                                  -> options(trans('settings::setting.options.currency.currency'),
                                  setting('currency.currency'))
                                  -> placeholder(trans('settings::setting.placeholder.currency.currency'))!!}
                              </div>

                              <div class="col-md-4">
                                  {!! Form::select('settings[user.currency.position]')
                                  -> label(trans('settings::setting.label.currency.position'))
                                  -> options(trans('settings::setting.options.currency.position'),
                                  setting('currency.position'))
                                  -> placeholder(trans('settings::setting.placeholder.currency.position'))!!}
                              </div>

                              <div class="col-md-4">
                                  {!! Form::text('settings[user.currency.thousandseperator]')
                                  -> label(trans('settings::setting.label.currency.thousandseperator'))
                                  -> value(setting('currency.thousandseperator'))
                                  -> placeholder(trans('settings::setting.placeholder.currency.thousandseperator'))!!}
                              </div>

                              <div class="col-md-4">
                                  {!! Form::text('settings[user.currency.decimalseperator]')
                                  -> label(trans('settings::setting.label.currency.decimalseperator'))
                                  -> value(setting('currency.decimalseperator'))
                                  -> placeholder(trans('settings::setting.placeholder.currency.decimalseperator'))!!}
                              </div>

                              <div class="col-md-4">
                                  {!! Form::text('settings[user.currency.decimal]')
                                  -> label(trans('settings::setting.label.currency.decimal'))
                                  -> value(setting('currency.decimal'))
                                  -> placeholder(trans('settings::setting.placeholder.currency.decimal'))!!}
                              </div>

                          </div>
                      </fieldset>
                  </div>
              </div>
              {!! Form::close() !!}
