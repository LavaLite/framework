              {!!Form::vertical_open()
              ->id('settings-setting-create')
              ->method('POST')
              ->files('true')
              ->action(trans_url('settings/theme'))!!}
              <div class='row'>
                <div class='col-md-12 col-sm-12'>
                      <fieldset>
                        <legend>{{trans('settings::setting.label.theme.admin.name')}}</legend>
                        <div class="row">
                          
                         <div class="col-md-4"> 
                           {!! Form::select('settings[main.admin.color]')
                           -> label(trans('settings::setting.label.theme.admin.color'))
                           -> options(__('settings::setting.options.theme'), setting('main.admin.color'))!!}
                          </div>
                         <div class="col-md-4"> 
                           {!! Form::file('upload[theme.admin.logo.logo][file]')
                           -> label(trans('settings::setting.label.theme.admin.logo.logo'))
                           -> placeholder(trans('settings::setting.placeholder.theme.admin.logo.logo'))!!}
                           {!! Form::hidden('upload[theme.admin.logo.logo][path]')
                           -> value(public_path('themes/admin/assets/img/logo/'))!!}
                          </div>
                         <div class="col-md-4"> 
                           {!! Form::file('upload[theme.admin.logo.white][file]')
                           -> label(trans('settings::setting.label.theme.admin.logo.white'))
                           -> placeholder(trans('settings::setting.placeholder.theme.admin.logo.white'))!!}
                           {!! Form::hidden('upload[theme.admin.logo.white][path]')
                           -> value(public_path('themes/admin/assets/img/logo/'))!!}
                         </div>
                        </div>
                      </fieldset>

                      <fieldset>
                        <legend>{{trans('settings::setting.label.theme.user.name')}}</legend>
                        <div class="row">
                         <div class="col-md-4"> 
                           {!! Form::select('settings[main.user.color]')
                           -> label(trans('settings::setting.label.theme.user.color'))
                           -> options(__('settings::setting.options.theme'), setting('main.user.color'))!!}
                          </div>
                         <div class="col-md-4"> 
                           {!! Form::file('upload[theme.user.logo.logo][file]')
                           -> label(trans('settings::setting.label.theme.user.logo.logo'))
                           -> placeholder(trans('settings::setting.placeholder.theme.user.logo.logo'))!!}
                           {!! Form::hidden('upload[theme.user.logo.logo][path]')
                           -> value(public_path('themes/user/assets/img/logo/'))!!}
                          </div>
                         <div class="col-md-4"> 
                           {!! Form::file('upload[theme.user.logo.white][file]')
                           -> label(trans('settings::setting.label.theme.user.logo.white'))
                           -> placeholder(trans('settings::setting.placeholder.theme.user.logo.white'))!!}
                           {!! Form::hidden('upload[theme.user.logo.white][path]')
                           -> value(public_path('themes/user/assets/img/logo/'))!!}
                         </div>
                        </div>
                      </fieldset>

                      <fieldset>
                        <legend>{{trans('settings::setting.label.theme.public.name')}}</legend>
                        <div class="row">
                          
                         <div class="col-md-4"> 
                           {!! Form::select('settings[main.public.color]')
                           -> label(trans('settings::setting.label.theme.public.color'))
                           -> options(__('settings::setting.options.theme'), setting('main.public.color'))!!}
                          </div>
                         <div class="col-md-4"> 
                           {!! Form::file('upload[theme.public.logo.logo][file]')
                           -> label(trans('settings::setting.label.theme.public.logo.logo'))
                           -> placeholder(trans('settings::setting.placeholder.theme.public.logo.logo'))!!}
                           {!! Form::hidden('upload[theme.public.logo.logo][path]')
                           -> value(public_path('themes/public/assets/img/logo/'))!!}
                          </div>
                         <div class="col-md-4"> 
                           {!! Form::file('upload[theme.public.logo.white][file]')
                           -> label(trans('settings::setting.label.theme.public.logo.white'))
                           -> placeholder(trans('settings::setting.placeholder.theme.public.logo.white'))!!}
                           {!! Form::hidden('upload[theme.public.logo.white][path]')
                           -> value(public_path('themes/public/assets/img/logo/'))!!}
                         </div>
                        </div>
                      </fieldset>


                </div>
            </div>
            {!! Form::close() !!}
            