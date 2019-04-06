              {!!Form::vertical_open()
              ->id('settings-setting-create')
              ->method('POST')
              ->files('true')
              ->action(URL::to('admin/settings/setting'))!!}
              <div class='row'>
                <div class='col-md-12 col-sm-12'>
                      <fieldset>
                        <legend>{{trans('settings::setting.label.theme.admin.name')}}</legend>
                        <div class="row">
                          
                         <div class="col-md-4"> 
                           {!! Form::select('settings[admin.color]')
                           -> label(trans('settings::setting.label.theme.admin.color'))
                           -> options(__('settings::setting.options.theme'), setting('admin.color'))!!}
                          </div>
                         <div class="col-md-4"> 
                           {!! Form::file('upload[theme_admin_logo_logo][file]')
                           -> label(trans('settings::setting.label.theme.admin.logo.logo'))
                           -> placeholder(trans('settings::setting.placeholder.theme.admin.logo.logo'))!!}
                           {!! Form::hidden('upload[theme_admin_logo_logo][path]')
                           -> value(public_path('themes/admin/assets/img/logo/logo.svg'))!!}
                          </div>
                         <div class="col-md-4"> 
                           {!! Form::file('upload[theme_admin_logo_white][file]')
                           -> label(trans('settings::setting.label.theme.admin.logo.white'))
                           -> placeholder(trans('settings::setting.placeholder.theme.admin.logo.white'))!!}
                           {!! Form::hidden('upload[theme_admin_logo_white][path]')
                           -> value(public_path('themes/admin/assets/img/logo/logo-white.svg'))!!}
                         </div>
                        </div>
                      </fieldset>

                      <fieldset>
                        <legend>{{trans('settings::setting.label.theme.user.name')}}</legend>
                        <div class="row">
                          
                         <div class="col-md-4"> 
                           {!! Form::select('settings[user.color]')
                           -> label(trans('settings::setting.label.theme.user.color'))
                           -> options(__('settings::setting.options.theme'), setting('user.color'))!!}
                          </div>
                         <div class="col-md-4"> 
                           {!! Form::file('upload[theme_user_logo_logo][file]')
                           -> label(trans('settings::setting.label.theme.user.logo.logo'))
                           -> placeholder(trans('settings::setting.placeholder.theme.user.logo.logo'))!!}
                           {!! Form::hidden('upload[theme_user_logo_logo][path]')
                           -> value(public_path('themes/user/assets/img/logo/logo.svg'))!!}
                          </div>
                         <div class="col-md-4"> 
                           {!! Form::file('upload[theme_user_logo_white][file]')
                           -> label(trans('settings::setting.label.theme.user.logo.white'))
                           -> placeholder(trans('settings::setting.placeholder.theme.user.logo.white'))!!}
                           {!! Form::hidden('upload[theme_user_logo_white][path]')
                           -> value(public_path('themes/user/assets/img/logo/logo-white.svg'))!!}
                         </div>
                        </div>
                      </fieldset>

                      <fieldset>
                        <legend>{{trans('settings::setting.label.theme.public.name')}}</legend>
                        <div class="row">
                          
                         <div class="col-md-4"> 
                           {!! Form::select('settings[public.color]')
                           -> label(trans('settings::setting.label.theme.public.color'))
                           -> options(__('settings::setting.options.theme'), setting('public.color'))!!}
                          </div>
                         <div class="col-md-4"> 
                           {!! Form::file('upload[theme_public_logo_logo][file]')
                           -> label(trans('settings::setting.label.theme.public.logo.logo'))
                           -> placeholder(trans('settings::setting.placeholder.theme.public.logo.logo'))!!}
                           {!! Form::hidden('upload[theme_public_logo_logo][path]')
                           -> value(public_path('themes/public/assets/img/logo/logo.svg'))!!}
                          </div>
                         <div class="col-md-4"> 
                           {!! Form::file('upload[theme_public_logo_white][file]')
                           -> label(trans('settings::setting.label.theme.public.logo.white'))
                           -> placeholder(trans('settings::setting.placeholder.theme.public.logo.white'))!!}

                           {!! Form::hidden('upload[theme_public_logo_white][path]')
                           -> value(public_path('themes/public/assets/img/logo/logo-white.svg'))!!}
                         </div>
                        </div>
                      </fieldset>


                </div>
            </div>
            {!! Form::close() !!}
            