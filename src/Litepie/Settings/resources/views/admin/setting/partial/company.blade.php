              {!!Form::vertical_open()
              ->id('settings-setting-create')
              ->method('POST')
              ->files('true')
              ->action(URL::to('admin/settings/setting'))!!}
              <div class='row'>
                <div class='col-md-12 col-sm-12'>
                       {!! Form::text('settings[company.name]')
                       -> label(trans('settings::setting.label.company.name'))
                       -> value(setting('company.name'))
                       -> placeholder(trans('settings::setting.placeholder.company.name'))!!}
                      <div class="row clearfix">

                        <div class="col-md-6">

                       {!! Form::text('settings[company.email]')
                       -> label(trans('settings::setting.label.company.email'))
                       -> value(setting('company.email'))
                       -> placeholder(trans('settings::setting.placeholder.company.email'))!!}
                        </div>
                        <div class="col-md-6">

                       {!! Form::text('settings[company.phone]')
                       -> label(trans('settings::setting.label.company.phone'))
                       -> value(setting('company.phone'))
                       -> placeholder(trans('settings::setting.placeholder.company.phone'))!!}
                        </div>
                      </div>
                       {!! Form::file('upload[logo.normal][file]')
                       -> label(trans('settings::setting.label.company.logo'))
                       -> label(trans('settings::setting.label.company.logo'))
                       -> placeholder(trans('settings::setting.placeholder.company.logo'))!!}

                       {!! Form::hidden('upload[logo.normal][path]')
                        -> value(public_path('assets/img/logo.png'))!!}

                       {!! Form::file('upload[logo.big][file]')
                       -> label(trans('settings::setting.label.company.logo_big'))
                       -> placeholder(trans('settings::setting.placeholder.company.logo_big'))!!}

                       {!! Form::hidden('upload[logo.big][path]')
                        -> value(public_path('assets/img/logo_big.png'))!!}

                       {!! Form::textarea('settings[company.address]')
                       -> label(trans('settings::setting.label.company.address'))
                       -> value(setting('company.address'))
                       -> placeholder(trans('settings::setting.placeholder.company.address'))!!}

                </div>
            </div>
            {!! Form::close() !!}
            