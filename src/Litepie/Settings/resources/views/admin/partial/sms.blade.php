              {!!Form::vertical_open()
              ->id('settings-setting-create')
              ->method('POST')
              ->files('true')
              ->action(guard_url('settings/sms'))!!}
              <div class='row'>
                  <div class='col-md-12 col-sm-12'>
                      <fieldset>
                          <div class="row">
                              <div class="col-md-12">
                                  {!! Form::url('settings[main.sms.url]')
                                  -> label(trans('settings::setting.label.sms.url'))
                                  -> value(setting('main.sms.url'))
                                  -> placeholder(trans('settings::setting.placeholder.sms.url'))!!}
                              </div>
                              <div class="col-md-12">
                                  {!! Form::text('settings[main.sms.code]')
                                  -> label(trans('settings::setting.label.sms.code'))
                                  -> value(setting('main.sms.code'))
                                  -> placeholder(trans('settings::setting.placeholder.sms.code'))!!}
                              </div>
                          </div>
                      </fieldset>
                  </div>
              </div>
              {!! Form::close() !!}
