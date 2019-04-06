            {!!Form::vertical_open()
            ->id('settings-setting-create')
            ->method('POST')
            ->files('true')
            ->action(URL::to('admin/settings/setting'))!!}
            <div class='row'>
                <div class='col-md-12 col-sm-12'>
                       {!! Form::text('settings[name]')
                       -> label(trans('settings::setting.label.name'))
                       -> value(setting('name'))
                       -> help(trans('settings::setting.help.name'))
                       -> placeholder(trans('settings::setting.placeholder.name'))!!}

                </div>
            </div>
            {!! Form::close() !!}
