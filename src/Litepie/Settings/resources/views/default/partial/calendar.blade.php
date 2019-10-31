              {!!Form::vertical_open()
              ->id('settings-setting-create')
              ->method('POST')
              ->files('true')
              ->action(trans_url('settings/calendar'))!!}
              <div class='row'>
                  <div class='col-md-12 col-sm-12'>
                      <fieldset>
                          <div class="row">
                              <div class="col-md-12">
                                  {!! Form::select('settings[user.calendar.provider]')
                                  -> label(trans('settings::setting.label.calendar.provider'))
                                  -> options(__('settings::setting.options.calendar.provider'),
                                  setting('user.calendar.provider'))!!}
                              </div>
                              <div class="col-md-12">
                                  {!! Form::textarea('settings[user.calendar.token]')
                                  -> label(trans('settings::setting.label.calendar.token'))
                                  -> value(setting('user.calendar.token'))
                                  -> placeholder(trans('settings::setting.placeholder.calendar.token'))!!}
                              </div>
                              <div class="col-md-12">
                                  {!! Form::textarea('settings[user.calendar.credentials]')
                                  -> label(trans('settings::setting.label.calendar.credentials'))
                                  -> value(setting('user.calendar.credentials'))
                                  -> placeholder(trans('settings::setting.placeholder.calendar.credentials'))!!}
                              </div>
                          </div>
                      </fieldset>
                  </div>
              </div>
              {!! Form::close() !!}
