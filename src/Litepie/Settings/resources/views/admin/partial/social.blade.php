              {!!Form::vertical_open()
              ->id('settings-setting-create')
              ->method('POST')
              ->files('true')
              ->action(trans_url('settings/mail'))!!}
              <div class='row'>
                  <div class='col-md-12 col-sm-12'>
                      <fieldset>
                          <legend>{{trans('settings::setting.label.social.twitter')}}</legend>
                          <div class="row">
                              <div class="col-md-6 col-sm-12">
                                  {!! Form::text('env[TWITTER_CLIENT_ID]')
                                  -> label(trans('settings::setting.label.social.twitter_client_id'))
                                  -> value(env('TWITTER_CLIENT_ID'))
                                  -> placeholder(trans('settings::setting.placeholder.social.twitter_client_id'))!!}
                              </div>
                              <div class="col-md-6 col-sm-12">
                                  {!! Form::password('env[TWITTER_CLIENT_SECRET]')
                                  -> label(trans('settings::setting.label.social.twitter_client_secret'))
                                  -> value(env('TWITTER_CLIENT_SECRET'))
                                  -> placeholder(trans('settings::setting.placeholder.social.twitter_client_secret'))!!}
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
                                  -> placeholder(trans('settings::setting.placeholder.social.facebook_client_id'))!!}
                              </div>
                              <div class="col-md-6 col-sm-12">
                                  {!! Form::password('env[FACEBOOK_CLIENT_SECRET]')
                                  -> label(trans('settings::setting.label.social.facebook_client_secret'))
                                  -> value(env('FACEBOOK_CLIENT_SECRET'))
                                  -> placeholder(trans('settings::setting.placeholder.social.facebook_client_secret'))!!}
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
                                  -> placeholder(trans('settings::setting.placeholder.social.google_client_id'))!!}
                              </div>
                              <div class="col-md-6 col-sm-12">
                                  {!! Form::password('env[GOOGLE_CLIENT_SECRET]')
                                  -> label(trans('settings::setting.label.social.google_client_secret'))
                                  -> value(env('GOOGLE_CLIENT_SECRET'))
                                  -> placeholder(trans('settings::setting.placeholder.social.google_client_secret'))!!}
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
                                  -> placeholder(trans('settings::setting.placeholder.social.linkedin_client_id'))!!}
                              </div>
                              <div class="col-md-6 col-sm-12">
                                  {!! Form::password('env[LINKEDIN_CLIENT_SECRET]')
                                  -> label(trans('settings::setting.label.social.linkedin_client_secret'))
                                  -> value(env('LINKEDIN_CLIENT_SECRET'))
                                  -> placeholder(trans('settings::setting.placeholder.social.linkedin_client_secret'))!!}
                              </div>
                          </div>
                      </fieldset>
                  </div>
              </div>
              {!! Form::close() !!}
