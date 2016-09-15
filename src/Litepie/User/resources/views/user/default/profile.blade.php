@include('public::notifications')
<div class="dashboard-content">
<div class="panel panel-color panel-inverse">
    <div class="panel-heading">
        <h3 class="panel-title">
            Update
            <span>
                profile
            </span>
        </h3>
        <p class="panel-sub-title m-t-5 text-muted">
            Update profile for {{ users('name') }}
        </p>
    </div>
    <div class="panel-body">
        {!!Form::vertical_open()
    ->id('contact')
    ->method('POST')
    ->class('update-profile')!!}
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                {!! Form::text('name')
        -> label(trans('user::user.user.label.name'))
        -> placeholder(trans('user::user.user.placeholder.name'))!!}
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                {!! Form::date('dob')
        -> label(trans('user::user.user.label.dob'))
        -> placeholder(trans('user::user.user.placeholder.dob'))!!}
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                {!! Form::text('designation')
        -> label(trans('user::user.user.label.designation'))
        -> placeholder(trans('user::user.user.placeholder.designation')) !!}
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                {!! Form::tel('mobile')
        -> label(trans('user::user.user.label.mobile'))
        -> placeholder(trans('user::user.user.placeholder.mobile')) !!}
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                {!! Form::tel('phone')
        -> label(trans('user::user.user.label.phone'))
        -> placeholder(trans('user::user.user.placeholder.phone')) !!}
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                {!! Form::text('address')
        -> label(trans('user::user.user.label.address'))
        -> placeholder(trans('user::user.user.placeholder.address')) !!}
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                {!! Form::text('street')
        -> label(trans('user::user.user.label.street'))
        -> placeholder(trans('user::user.user.placeholder.street')) !!}
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                {!! Form::text('city')
        -> label(trans('user::user.user.label.city'))
        -> placeholder(trans('user::user.user.placeholder.city')) !!}
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                {!! Form::text('district')
        -> label(trans('user::user.user.label.district'))
        -> placeholder(trans('user::user.user.placeholder.district')) !!}
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                {!! Form::text('state')
        -> label(trans('user::user.user.label.state'))
        -> placeholder(trans('user::user.user.placeholder.state')) !!}
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                {!! Form::text('country')
        -> label(trans('user::user.user.label.country'))
        -> placeholder(trans('user::user.user.placeholder.country')) !!}
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                {!! Form::url('web')
        -> label(trans('user::user.user.label.web'))
        -> placeholder(trans('user::user.user.placeholder.web')) !!}
            </div>
        </div>
        {!! Form::submit(trans('cms.save'))->class('btn btn-primary')!!}
        <br>
            <br>
                {!! Form::close() !!}
            </br>
        </br>
    </div>
</div>
</div>
