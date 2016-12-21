  {!! Form::hidden('upload_folder')!!}  
<div class='col-md-4 col-sm-6'>
                       {!! Form::text('status')
                       -> label(trans('message::message.label.status'))
                       -> placeholder(trans('message::message.placeholder.status'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                       {!! Form::text('star')
                       -> label(trans('message::message.label.star'))
                       -> placeholder(trans('message::message.placeholder.star'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                       {!! Form::text('from')
                       -> label(trans('message::message.label.from'))
                       -> placeholder(trans('message::message.placeholder.from'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                       {!! Form::text('to')
                       -> label(trans('message::message.label.to'))
                       -> placeholder(trans('message::message.placeholder.to'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                       {!! Form::text('subject')
                       -> label(trans('message::message.label.subject'))
                       -> placeholder(trans('message::message.placeholder.subject'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                       {!! Form::text('message')
                       -> label(trans('message::message.label.message'))
                       -> placeholder(trans('message::message.placeholder.message'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                       {!! Form::text('read')
                       -> label(trans('message::message.label.read'))
                       -> placeholder(trans('message::message.placeholder.read'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                       {!! Form::text('type')
                       -> label(trans('message::message.label.type'))
                       -> placeholder(trans('message::message.placeholder.type'))!!}
                </div>

{!!   Form::actions()
->large_primary_submit('Submit')
->large_inverse_reset('Reset')
!!}