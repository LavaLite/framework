<div class='col-md-4 col-sm-6'>
                       {!! Form::text('type')
                       -> label(trans('alert::notification.label.type'))
                       -> placeholder(trans('alert::notification.placeholder.type'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                       {!! Form::text('notifiable_id')
                       -> label(trans('alert::notification.label.notifiable_id'))
                       -> placeholder(trans('alert::notification.placeholder.notifiable_id'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                       {!! Form::text('notifiable_type')
                       -> label(trans('alert::notification.label.notifiable_type'))
                       -> placeholder(trans('alert::notification.placeholder.notifiable_type'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                    {!! Form::textarea ('data')
                    -> label(trans('alert::notification.label.data'))
                    -> placeholder(trans('alert::notification.placeholder.data'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                       {!! Form::datetime('read_at')
                       -> label(trans('alert::notification.label.read_at'))
                       -> placeholder(trans('alert::notification.placeholder.read_at'))!!}
                </div>

{!!   Form::alerts()
->large_primary_submit('Submit')
->large_inverse_reset('Reset')
!!}