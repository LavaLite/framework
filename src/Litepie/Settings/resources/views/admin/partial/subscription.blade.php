              {!!Form::vertical_open()
              ->id('settings-setting-create')
              ->method('POST')
              ->files('true')
              ->action(trans_url('settings/mail'))!!}
              <div class='row'>
                <div class='col-md-12 col-sm-12'>
                      <fieldset>
                        <div class="row">
                          
                         <div class="col-md-12"> 
                           {!! Form::select('env[MAIL_DRIVER]')
                           -> label(trans('settings::setting.label.mail.driver'))
                           -> options(__('settings::setting.options.mail.driver'), env('MAIL_DRIVER'))!!}
                         </div>
                         <div class="col-md-12">
                             {!! Form::text('env[MAIL_HOST]')
                             -> label(trans('settings::setting.label.mail.host'))
                             -> value(env('MAIL_HOST'))
                             -> placeholder(trans('settings::setting.placeholder.mail.host'))!!}
                         </div>
                         <div class="col-md-12">
                             {!! Form::text('env[MAIL_PORT]')
                             -> label(trans('settings::setting.label.mail.port'))
                             -> value(env('MAIL_PORT'))
                             -> placeholder(trans('settings::setting.placeholder.mail.port'))!!}
                         </div>
                         <div class="col-md-12">
                             {!! Form::text('env[MAIL_USERNAME]')
                             -> label(trans('settings::setting.label.mail.user'))
                             -> value(env('MAIL_USERNAME'))
                             -> placeholder(trans('settings::setting.placeholder.mail.user'))!!}
                         </div>
                         <div class="col-md-12">
                             {!! Form::text('env[MAIL_PASSWORD]')
                             -> label(trans('settings::setting.label.mail.password'))
                             -> value(env('MAIL_PASSWORD'))
                             -> placeholder(trans('settings::setting.placeholder.mail.password'))!!}
                         </div>
                         <div class="col-md-12">
                           {!! Form::select('env[MAIL_ENCRYPTION]')
                           -> label(trans('settings::setting.label.mail.encryption'))
                           -> options(__('settings::setting.options.mail.encryption'), env('MAIL_ENCRYPTION'))!!}
                         </div>
                        </div>
                      </fieldset>
                </div>
            </div>
            {!! Form::close() !!}
            