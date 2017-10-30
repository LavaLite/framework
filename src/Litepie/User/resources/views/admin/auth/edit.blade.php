@include('public::notifications')


    {!!Form::vertical_open()
    ->id('form-update-profile')
    ->method('POST')
    ->action('admin/profile')
    ->class('update-profile')!!}

    <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        {!! Form::text('name')
        -> label(trans('user::user.label.name'))
        -> placeholder(trans('user::user.placeholder.name'))!!}

        {!! Form::date('dob')
        -> label(trans('user::user.label.dob'))
        -> placeholder(trans('user::user.placeholder.dob'))!!}

        {!! Form::text('designation')
        -> label(trans('user::user.label.designation'))
        -> placeholder(trans('user::user.placeholder.designation')) !!}

        {!! Form::tel('mobile')
        -> label(trans('user::user.label.mobile'))
        -> placeholder(trans('user::user.placeholder.mobile')) !!}  
              
        {!! Form::tel('phone')
        -> label(trans('user::user.label.phone'))
        -> placeholder(trans('user::user.placeholder.phone')) !!}        

        </div>

        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">    
                {!! $user->files('photo')->url($user->getUploadUrl('photo'))->cropper($user->picture)!!}
        </div>

    </div>

    <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        {!! Form::text('address')
        -> label(trans('user::user.label.address'))
        -> placeholder(trans('user::user.placeholder.address')) !!}
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        {!! Form::text('street')
        -> label(trans('user::user.label.street'))
        -> placeholder(trans('user::user.placeholder.street')) !!}
        </div>
    </div>
    <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        {!! Form::text('city')
        -> label(trans('user::user.label.city'))
        -> placeholder(trans('user::user.placeholder.city')) !!}
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        {!! Form::text('district')
        -> label(trans('user::user.label.district'))
        -> placeholder(trans('user::user.placeholder.district')) !!}
        </div>
    </div>
    <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        {!! Form::text('state')
        -> label(trans('user::user.label.state'))
        -> placeholder(trans('user::user.placeholder.state')) !!}
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        {!! Form::text('country')
        -> label(trans('user::user.label.country'))
        -> placeholder(trans('user::user.placeholder.country')) !!}
        </div>
    </div>
    <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        {!! Form::url('web')
        -> label(trans('user::user.label.web'))
        -> placeholder(trans('user::user.placeholder.web')) !!}
        </div>
    </div>


    {!! Form::close() !!}
