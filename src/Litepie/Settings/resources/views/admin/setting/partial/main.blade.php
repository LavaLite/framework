            <div class='row'>
                <div class='col-md-4 col-sm-6'>
                       {!! Form::text('main[main.name]')
                       -> label(trans('settings::setting.label.main.name'))
                       -> value(setting('main.name'))
                       -> placeholder(trans('settings::setting.placeholder.main.name'))!!}
                </div>
            </div>