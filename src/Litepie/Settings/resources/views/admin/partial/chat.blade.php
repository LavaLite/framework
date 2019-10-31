              {!!Form::vertical_open()
              ->id('settings-setting-create')
              ->method('POST')
              ->files('true')
              ->action(trans_url('settings/chat'))!!}
              <div class='row'>
                <div class='col-md-12 col-sm-12'>
                      <fieldset>
                        <div class="row">
                         <div class="col-md-12"> 
                            {!! Form::textarea('settings[main.chat.twalkto]')
                            -> label(trans('settings::setting.label.chat.twalkto'))
                            -> value(setting('main.chat.twalkto'))
                            -> placeholder(trans('settings::setting.placeholder.chat.twalkto'))!!}
                         </div>
                         <div class="col-md-12">
                             {!! Form::textarea('settings[main.chat.freshchat]')
                             -> label(trans('settings::setting.label.chat.freshchat'))
                             -> value(setting('main.chat.freshchat'))
                             -> placeholder(trans('settings::setting.placeholder.chat.freshchat'))!!}
                         </div>
                        </div>
                      </fieldset>
                </div>
            </div>
            {!! Form::close() !!}
            