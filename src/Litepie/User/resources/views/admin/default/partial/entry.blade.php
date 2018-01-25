            <div class='row'>
                <div class='col-md-4 col-sm-6'>
                       {!! Form::text('name')
                       -> label(trans('user::client.label.name'))
                       -> placeholder(trans('user::client.placeholder.name'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                       {!! Form::email('email')
                       -> label(trans('user::client.label.email'))
                       -> placeholder(trans('user::client.placeholder.email'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                       {!! Form::password('password')
                       -> label(trans('user::client.label.password'))
                       -> placeholder(trans('user::client.placeholder.password'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                   {!! Form::inline_radios('sex')
                   -> radios(trans('user::client.options.sex'))
                   -> label(trans('user::client.label.sex'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                   <div class='form-group'>
                     <label for='dob' class='control-label'>{!!trans('user::client.label.dob')!!}</label>
                     <div class='input-group pickdate'>
                        {!! Form::text('dob')
                        -> placeholder(trans('user::client.placeholder.dob'))
                        ->raw()!!}
                       <span class='input-group-addon'><i class='fa fa-calendar'></i></span>
                     </div>
                   </div>
                </div>

                <div class='col-md-4 col-sm-6'>
                       {!! Form::tel('mobile')
                       -> label(trans('user::client.label.mobile'))
                       -> placeholder(trans('user::client.placeholder.mobile'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                       {!! Form::tel('phone')
                       -> label(trans('user::client.label.phone'))
                       -> placeholder(trans('user::client.placeholder.phone'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                    {!! Form::textarea ('address')
                    -> label(trans('user::client.label.address'))
                    -> placeholder(trans('user::client.placeholder.address'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                       {!! Form::text('street')
                       -> label(trans('user::client.label.street'))
                       -> placeholder(trans('user::client.placeholder.street'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                       {!! Form::text('city')
                       -> label(trans('user::client.label.city'))
                       -> placeholder(trans('user::client.placeholder.city'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                       {!! Form::text('district')
                       -> label(trans('user::client.label.district'))
                       -> placeholder(trans('user::client.placeholder.district'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                       {!! Form::text('state')
                       -> label(trans('user::client.label.state'))
                       -> placeholder(trans('user::client.placeholder.state'))!!}
                </div>

                <div class='col-md-4 col-sm-6'>
                       {!! Form::numeric('country')
                       -> label(trans('user::client.label.country'))
                       -> placeholder(trans('user::client.placeholder.country'))!!}
                </div>



                <div class='col-md-4 col-sm-6'>
                       {!! Form::text('web')
                       -> label(trans('user::client.label.web'))
                       -> placeholder(trans('user::client.placeholder.web'))!!}
                </div>
            </div>