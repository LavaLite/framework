<div class='col-md-4 col-sm-6'>
                       {!! Form::text('type')
                       -> label(trans('alerts::notification.label.type'))
                       -> placeholder(trans('alerts::notification.placeholder.type'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                       {!! Form::text('notifiable_id')
                       -> label(trans('alerts::notification.label.notifiable_id'))
                       -> placeholder(trans('alerts::notification.placeholder.notifiable_id'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                       {!! Form::text('notifiable_type')
                       -> label(trans('alerts::notification.label.notifiable_type'))
                       -> placeholder(trans('alerts::notification.placeholder.notifiable_type'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                    {!! Form::textarea ('data')
                    -> label(trans('alerts::notification.label.data'))
                    -> placeholder(trans('alerts::notification.placeholder.data'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                       {!! Form::datetime('read_at')
                       -> label(trans('alerts::notification.label.read_at'))
                       -> placeholder(trans('alerts::notification.placeholder.read_at'))!!}
                </div>

{!!   Form::alerts()
->large_primary_submit('Submit')
->large_inverse_reset('Reset')
!!}