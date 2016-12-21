  {!! Form::hidden('upload_folder')!!}  
<div class='col-md-4 col-sm-6'>
                       {!! Form::text('name')
                       -> label(trans('contact::contact.label.name'))
                       -> placeholder(trans('contact::contact.placeholder.name'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                       {!! Form::number('phone')
                       -> label(trans('contact::contact.label.phone'))
                       -> placeholder(trans('contact::contact.placeholder.phone'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                       {!! Form::number('mobile')
                       -> label(trans('contact::contact.label.mobile'))
                       -> placeholder(trans('contact::contact.placeholder.mobile'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                       {!! Form::text('email')
                       -> label(trans('contact::contact.label.email'))
                       -> placeholder(trans('contact::contact.placeholder.email'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                       {!! Form::text('website')
                       -> label(trans('contact::contact.label.website'))
                       -> placeholder(trans('contact::contact.placeholder.website'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                       {!! Form::text('address')
                       -> label(trans('contact::contact.label.address'))
                       -> placeholder(trans('contact::contact.placeholder.address'))!!}
                </div>

{!!   Form::actions()
->large_primary_submit('Submit')
->large_inverse_reset('Reset')
!!}