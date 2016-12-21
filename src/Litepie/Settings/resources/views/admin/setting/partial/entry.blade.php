            <div class='row'>
                <div class='col-md-4 col-sm-6'>
                       {!! Form::text('skey')
                       -> required()
                       -> label(trans('settings::setting.label.skey'))
                       -> placeholder(trans('settings::setting.placeholder.skey'))!!}
                </div>
                <div class='col-md-4 col-sm-6'>
                       {!! Form::text('name')
                       -> label(trans('settings::setting.label.name'))
                       -> placeholder(trans('settings::setting.placeholder.name'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                       {!! Form::text('value')
                       -> label(trans('settings::setting.label.value'))
                       -> placeholder(trans('settings::setting.placeholder.value'))!!}
                </div>            

                <div class='col-md-4 col-sm-6'>
                       {!! Form::select('type')
                       -> options(trans('settings::setting.options.type'))
                       -> label(trans('settings::setting.label.type'))
                       -> placeholder(trans('settings::setting.placeholder.type'))!!}
                </div>
            </div>