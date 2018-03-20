            <div class='row'>
                <div class='col-md-4 col-sm-6'>
                       {!! Form::text('user[user.name]')
                       -> label(trans('settings::setting.label.user.name'))
                       -> value(setting()->user('user.name'))
                       -> placeholder(trans('settings::setting.placeholder.user.name'))!!}
                </div>
            </div>