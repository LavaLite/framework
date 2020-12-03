<div class="app-entry-form-wrap">
    <div class="app-sec-title app-sec-title-with-icon app-sec-title-with-action">
        <i class="lab la-product-hunt app-sec-title-icon"></i>
        <h2> {!! trans('settings::setting.name') !!} <small> {!! trans('app.manage') !!} {!!
                trans('settings::setting.names') !!}</small></h2>
        <div class="actions">
            <button type="button" class="btn btn-with-icon btn-link  btn-outline" 
                data-action='UPDATE'
                data-form="#form-edit" 
                data-load-to="#app-entry" >
                <i class="las la-save"></i>{{__('Save')}}
            </button>
            <button type="button" class="btn btn-with-icon btn-link  btn-outline"
                data-action='SHOW'
                data-load-to="#app-entry" 
                data-url="{{guard_url('settings/0')}}">
                <i class="las la-window-close"></i>{{__('Cancel')}}
            </button>
        </div>
    </div>
    {!!Form::vertical_open()
    ->id('form-edit')
    ->method('POST')
    ->files('true')
    ->action(guard_url('settings/social'))!!}
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="app-entry-form-section" id="basic">
                    <div class="section-title">{!! trans('settings::setting.names') !!}</div>
                    <div class='row'>
                        <div class='col-md-12 col-sm-12'>
                            <div class='row'>
                                <div class='col-md-12 col-sm-12'>
                                    <fieldset>
                                        <legend>{{trans('settings::setting.label.social.twitter')}}</legend>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                {!! Form::text('env[TWITTER_CLIENT_ID]')
                                                -> label(trans('settings::setting.label.social.twitter_client_id'))
                                                -> value(env('TWITTER_CLIENT_ID'))
                                                ->
                                                placeholder(trans('settings::setting.placeholder.social.twitter_client_id'))!!}
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                {!! Form::password('env[TWITTER_CLIENT_SECRET]')
                                                -> label(trans('settings::setting.label.social.twitter_client_secret'))
                                                -> value(env('TWITTER_CLIENT_SECRET'))
                                                ->
                                                placeholder(trans('settings::setting.placeholder.social.twitter_client_secret'))!!}
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <legend>{{trans('settings::setting.label.social.facebook')}}</legend>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                {!! Form::text('env[FACEBOOK_CLIENT_ID]')
                                                -> label(trans('settings::setting.label.social.facebook_client_id'))
                                                -> value(env('FACEBOOK_CLIENT_ID'))
                                                ->
                                                placeholder(trans('settings::setting.placeholder.social.facebook_client_id'))!!}
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                {!! Form::password('env[FACEBOOK_CLIENT_SECRET]')
                                                -> label(trans('settings::setting.label.social.facebook_client_secret'))
                                                -> value(env('FACEBOOK_CLIENT_SECRET'))
                                                ->
                                                placeholder(trans('settings::setting.placeholder.social.facebook_client_secret'))!!}
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <legend>{{trans('settings::setting.label.social.google')}}</legend>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                {!! Form::text('env[GOOGLE_CLIENT_ID]')
                                                -> label(trans('settings::setting.label.social.google_client_id'))
                                                -> value(env('GOOGLE_CLIENT_ID'))
                                                ->
                                                placeholder(trans('settings::setting.placeholder.social.google_client_id'))!!}
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                {!! Form::password('env[GOOGLE_CLIENT_SECRET]')
                                                -> label(trans('settings::setting.label.social.google_client_secret'))
                                                -> value(env('GOOGLE_CLIENT_SECRET'))
                                                ->
                                                placeholder(trans('settings::setting.placeholder.social.google_client_secret'))!!}
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <legend>{{trans('settings::setting.label.social.linkedin')}}</legend>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                {!! Form::text('env[LINKEDIN_CLIENT_ID]')
                                                -> label(trans('settings::setting.label.social.linkedin_client_id'))
                                                -> value(env('LINKEDIN_CLIENT_ID'))
                                                ->
                                                placeholder(trans('settings::setting.placeholder.social.linkedin_client_id'))!!}
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                {!! Form::password('env[LINKEDIN_CLIENT_SECRET]')
                                                -> label(trans('settings::setting.label.social.linkedin_client_secret'))
                                                -> value(env('LINKEDIN_CLIENT_SECRET'))
                                                ->
                                                placeholder(trans('settings::setting.placeholder.social.linkedin_client_secret'))!!}
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>