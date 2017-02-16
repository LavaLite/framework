<div class='col-md-4 col-sm-6'>
                       {!! Form::text('name')
                       -> label(trans('contact::contact.label.name'))
                       -> placeholder(trans('contact::contact.placeholder.name'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                       {!! Form::text('phone')
                       -> label(trans('contact::contact.label.phone'))
                       -> placeholder(trans('contact::contact.placeholder.phone'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                       {!! Form::text('mobile')
                       -> label(trans('contact::contact.label.mobile'))
                       -> placeholder(trans('contact::contact.placeholder.mobile'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                       {!! Form::text('email')
                       -> label(trans('contact::contact.label.email'))
                       -> placeholder(trans('contact::contact.placeholder.email'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                       {!! Form::text('default')
                       -> label(trans('contact::contact.label.default'))
                       -> placeholder(trans('contact::contact.placeholder.default'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                       {!! Form::text('website')
                       -> label(trans('contact::contact.label.website'))
                       -> placeholder(trans('contact::contact.placeholder.website'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                       {!! Form::text('details')
                       -> label(trans('contact::contact.label.details'))
                       -> placeholder(trans('contact::contact.placeholder.details'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                       {!! Form::text('address_line1')
                       -> label(trans('contact::contact.label.address_line1'))
                       -> placeholder(trans('contact::contact.placeholder.address_line1'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                       {!! Form::text('address_line2')
                       -> label(trans('contact::contact.label.address_line2'))
                       -> placeholder(trans('contact::contact.placeholder.address_line2'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                       {!! Form::text('street')
                       -> label(trans('contact::contact.label.street'))
                       -> placeholder(trans('contact::contact.placeholder.street'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                       {!! Form::text('city')
                       -> label(trans('contact::contact.label.city'))
                       -> placeholder(trans('contact::contact.placeholder.city'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                       {!! Form::text('country')
                       -> label(trans('contact::contact.label.country'))
                       -> placeholder(trans('contact::contact.placeholder.country'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                       {!! Form::text('pin_code')
                       -> label(trans('contact::contact.label.pin_code'))
                       -> placeholder(trans('contact::contact.placeholder.pin_code'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                       {!! Form::text('lat')
                       -> label(trans('contact::contact.label.lat'))
                       -> placeholder(trans('contact::contact.placeholder.lat'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                       {!! Form::text('lng')
                       -> label(trans('contact::contact.label.lng'))
                       -> placeholder(trans('contact::contact.placeholder.lng'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                       {!! Form::text('status')
                       -> label(trans('contact::contact.label.status'))
                       -> placeholder(trans('contact::contact.placeholder.status'))!!}
                </div>

{!!   Form::actions()
->large_primary_submit('Submit')
->large_inverse_reset('Reset')
!!}