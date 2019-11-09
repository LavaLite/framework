              {!!Form::vertical_open()
              ->id('settings-setting-create')
              ->method('POST')
              ->files('true')
              ->action(guard_url('settings/google'))!!}
              <div class='row'>
                <div class='col-md-12 col-sm-12'>
                      <fieldset>
                        <div class="row">
                         <div class="col-md-12">
                             {!! Form::text('env[GOOGLE_ANALYTICS]')
                             -> label(trans('settings::setting.label.google.analytics'))
                             -> value(env('GOOGLE_ANALYTICS'))
                             -> placeholder(trans('settings::setting.placeholder.google.analytics'))!!}
                         </div>
                         <div class="col-md-12">
                             {!! Form::text('env[GOOGLE_RECAPTCHA]')
                             -> label(trans('settings::setting.label.google.recaptcha'))
                             -> value(env('GOOGLE_RECAPTCHA'))
                             -> placeholder(trans('settings::setting.placeholder.google.recaptcha'))!!}
                         </div>
                        </div>
                      </fieldset>
                </div>
            </div>
            {!! Form::close() !!}
            