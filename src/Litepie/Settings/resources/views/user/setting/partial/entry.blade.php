<div class='col-md-4 col-sm-6'>
                       {!! Form::text('key')
                       -> label(trans('settings::setting.label.key'))
                       -> placeholder(trans('settings::setting.placeholder.key'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                       {!! Form::text('package')
                       -> label(trans('settings::setting.label.package'))
                       -> placeholder(trans('settings::setting.placeholder.package'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                       {!! Form::text('module')
                       -> label(trans('settings::setting.label.module'))
                       -> placeholder(trans('settings::setting.placeholder.module'))!!}
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
                       {!! Form::text('file')
                       -> label(trans('settings::setting.label.file'))
                       -> placeholder(trans('settings::setting.placeholder.file'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                       {!! Form::text('control')
                       -> label(trans('settings::setting.label.control'))
                       -> placeholder(trans('settings::setting.placeholder.control'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                       {!! Form::text('type')
                       -> label(trans('settings::setting.label.type'))
                       -> placeholder(trans('settings::setting.placeholder.type'))!!}
                </div>

{!!   Form::actions()
->large_primary_submit('Submit')
->large_inverse_reset('Reset')
!!}