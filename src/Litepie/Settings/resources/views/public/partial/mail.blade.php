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
                           {!! Form::select('setting[user.mail.driver]')
                           -> label(trans('settings::setting.label.mail.driver'))
                           -> options(__('settings::setting.options.mail.driver'), setting('MAIL_DRIVER'))!!}
                         </div>
                         <div class="col-md-12">
                             {!! Form::text('setting[user.mail.host]')
                             -> label(trans('settings::setting.label.mail.host'))
                             -> value(setting('MAIL_HOST'))
                             -> placeholder(trans('settings::setting.placeholder.mail.host'))!!}
                         </div>
                         <div class="col-md-12">
                             {!! Form::text('setting[user.mail.port]')
                             -> label(trans('settings::setting.label.mail.port'))
                             -> value(setting('MAIL_PORT'))
                             -> placeholder(trans('settings::setting.placeholder.mail.port'))!!}
                         </div>
                         <div class="col-md-12">
                             {!! Form::text('setting[user.mail.user]')
                             -> label(trans('settings::setting.label.mail.user'))
                             -> value(setting('MAIL_USERNAME'))
                             -> placeholder(trans('settings::setting.placeholder.mail.user'))!!}
                         </div>
                         <div class="col-md-12">
                             {!! Form::text('setting[user.mail.password]')
                             -> label(trans('settings::setting.label.mail.password'))
                             -> value(setting('MAIL_PASSWORD'))
                             -> placeholder(trans('settings::setting.placeholder.mail.password'))!!}
                         </div>
                         <div class="col-md-12">
                           {!! Form::select('setting[user.mail.encryption]')
                           -> label(trans('settings::setting.label.mail.encryption'))
                           -> options(__('settings::setting.options.mail.encryption'), setting('MAIL_ENCRYPTION'))!!}
                         </div>
                        </div>
                      </fieldset>
                </div>
            </div>
            {!! Form::close() !!}
            