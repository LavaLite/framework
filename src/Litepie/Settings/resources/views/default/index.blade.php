<div class="app-list-wrap">
    <div class="app-list-inner">
        <div class="app-list-header d-flex align-items-center justify-content-between">
            <h3>{!! trans('settings::setting.names') !!} </h3>
          
        </div>

        <div class="app-list-wrap-inner ps ps--active-y" id="app-list">
            <div class="app-list-head">
            <h4>{{trans('settings::setting.title.general')}}</h4>
            </div>
            
            <div class="app-item" >
                <div class="app-info"  data-action='SHOW' data-load-to="#app-entry"
                    data-url="{{guard_url('settings/main')}}">
                    <input type="checkbox" name="tasks_list" id="task_">
                    <label class="app-project-name bg-primary"
                        for="">{{trans('settings::setting.title.main')[0]}}</label>
                    <h3 style="margin-bottom: 10px;">{{trans('settings::setting.title.main')}}</h3>
                    <div class="app-metas">
                        <p></p>
                        <span class="badge badge-status in-progress"></span>
                    </div>
                </div>
                <div class="app-actions">
                    <a href="{{guard_url('settings/main')}}" class="btn las la-pencil-alt" data-action='EDIT'
                        data-load-to="#app-entry" data-url="{{guard_url('settings/main')}}">
                    </a>
                </div>
            </div>
            <div class="app-item ">
                <div class="app-info"  data-action='SHOW' data-load-to="#app-entry"
                        data-url="{{guard_url('settings/company')}}">
                    <input type="checkbox" name="tasks_list" id="task_">
                    <label class="app-project-name bg-warning"
                        for="">{{trans('settings::setting.title.company')[0]}}</label>
                    <h3 style="margin-bottom: 10px;">{{trans('settings::setting.title.company')}}</h3>
                    <div class="app-metas">
                        <p></p>
                        <span class="badge badge-status in-progress"></span>
                    </div>
                </div>
                <div class="app-actions">
                    <a href="{{guard_url('settings/company')}}" class="btn las la-pencil-alt" data-action='EDIT'
                        data-load-to="#app-entry" data-url="{{guard_url('settings/company')}}">
                    </a>
                </div>
            </div>
            <div class="app-item ">
                <div class="app-info"  data-action='SHOW' data-load-to="#app-entry"
                        data-url="{{guard_url('settings/theme')}}">
                    <input type="checkbox" name="tasks_list" id="task_">
                    <label class="app-project-name bg-secondary"
                        for="">{{trans('settings::setting.title.theme')[0]}}</label>
                    <h3 style="margin-bottom: 10px;">{{trans('settings::setting.title.theme')}}</h3>
                    <div class="app-metas">
                        <p></p>
                        <span class="badge badge-status in-progress"></span>
                    </div>
                </div>
                <div class="app-actions">
                    <a href="{{guard_url('settings/theme')}}" class="btn las la-pencil-alt" data-action='EDIT'
                        data-load-to="#app-entry" data-url="{{guard_url('settings/theme')}}">
                    </a>
                </div>
            </div>
            <div class="app-list-head">
            <h4>{{trans('settings::setting.title.subscription')}}</h4>
            </div>
            <div class="app-item ">
                <div class="app-info"  data-action='SHOW' data-load-to="#app-entry"
                        data-url="{{guard_url('settings/social')}}">
                    <input type="checkbox" name="tasks_list" id="task_">
                    <label class="app-project-name bg-warning"
                        for="">{{trans('settings::setting.title.team')[0]}}</label>
                    <h3 style="margin-bottom: 10px;">{{trans('settings::setting.title.team')}}</h3>
                    <div class="app-metas">
                        <p></p>
                        <span class="badge badge-status in-progress"></span>
                    </div>
                </div>
                <div class="app-actions">
                    <a href="{{guard_url('settings/social')}}" class="btn las la-pencil-alt" data-action='EDIT'
                        data-load-to="#app-entry" data-url="{{guard_url('settings/social')}}">
                    </a>
                </div>
            </div>
            <div class="app-item ">
                <div class="app-info" data-action='SHOW' data-load-to="#app-entry"
                        data-url="{{guard_url('settings/social')}}">
                    <input type="checkbox" name="tasks_list" id="task_">
                    <label class="app-project-name bg-primary"
                        for="">{{trans('settings::setting.title.subscriptions')[0]}}</label>
                    <h3 style="margin-bottom: 10px;">{{trans('settings::setting.title.subscriptions')}}</h3>
                    <div class="app-metas">
                        <p></p>
                        <span class="badge badge-status in-progress"></span>
                    </div>
                </div>
                <div class="app-actions">
                    <a href="{{guard_url('settings/social')}}" class="btn las la-pencil-alt" data-action='EDIT'
                        data-load-to="#app-entry" data-url="{{guard_url('settings/social')}}">
                    </a>
                </div>
            </div>
            <div class="app-list-head">
            <h4>{{trans('settings::setting.title.integration')}}</h4>
            </div>
            <div class="app-item ">
                <div class="app-info"  data-action='SHOW' data-load-to="#app-entry"
                        data-url="{{guard_url('settings/social')}}">
                    <input type="checkbox" name="tasks_list" id="task_">
                    <label class="app-project-name bg-secondary"
                        for="">{{trans('settings::setting.title.social')[0]}}</label>
                    <h3 style="margin-bottom: 10px;">{{trans('settings::setting.title.social')}}</h3>
                    <div class="app-metas">
                        <p></p>
                        <span class="badge badge-status in-progress"></span>
                    </div>
                </div>
                <div class="app-actions">
                    <a href="{{guard_url('settings/social')}}" class="btn las la-pencil-alt" data-action='EDIT'
                        data-load-to="#app-entry" data-url="{{guard_url('settings/social')}}">
                    </a>
                </div>
            </div>
            <div class="app-item ">
                <div class="app-info"  data-action='SHOW' data-load-to="#app-entry"
                        data-url="{{guard_url('settings/payment')}}">
                    <input type="checkbox" name="tasks_list" id="task_">
                    <label class="app-project-name bg-warning"
                        for="">{{trans('settings::setting.title.payment')[0]}}</label>
                    <h3 style="margin-bottom: 10px;">{{trans('settings::setting.title.payment')}}</h3>
                    <div class="app-metas">
                        <p></p>
                        <span class="badge badge-status in-progress"></span>
                    </div>
                </div>
                <div class="app-actions">
                    <a href="{{guard_url('settings/payment')}}" class="btn las la-pencil-alt" data-action='EDIT'
                        data-load-to="#app-entry" data-url="{{guard_url('settings/payment')}}">
                    </a>
                </div>
            </div>
            <div class="app-item ">
                <div class="app-info"  data-action='SHOW' data-load-to="#app-entry"
                        data-url="{{guard_url('settings/mail')}}">
                    <input type="checkbox" name="tasks_list" id="task_">
                    <label class="app-project-name bg-primary"
                        for="">{{trans('settings::setting.title.email')[0]}}</label>
                    <h3 style="margin-bottom: 10px;">{{trans('settings::setting.title.email')}}</h3>
                    <div class="app-metas">
                        <p></p>
                        <span class="badge badge-status in-progress"></span>
                    </div>
                </div>
                <div class="app-actions">
                    <a href="{{guard_url('settings/mail')}}" class="btn las la-pencil-alt" data-action='EDIT'
                        data-load-to="#app-entry" data-url="{{guard_url('settings/mail')}}">
                    </a>
                </div>
            </div>
            <div class="app-item ">
                <div class="app-info" data-action='SHOW' data-load-to="#app-entry"
                        data-url="{{guard_url('settings/sms')}}">
                    <input type="checkbox" name="tasks_list" id="task_">
                    <label class="app-project-name bg-secondary"
                        for="">{{trans('settings::setting.title.sms')[0]}}</label>
                    <h3 style="margin-bottom: 10px;">{{trans('settings::setting.title.sms')}}</h3>
                    <div class="app-metas">
                        <p></p>
                        <span class="badge badge-status in-progress"></span>
                    </div>
                </div>
                <div class="app-actions">
                    <a href="{{guard_url('settings/sms')}}" class="btn las la-pencil-alt" data-action='EDIT'
                        data-load-to="#app-entry" data-url="{{guard_url('settings/sms')}}">
                    </a>
                </div>
            </div>
            <div class="app-item ">
                <div class="app-info"  data-action='SHOW' data-load-to="#app-entry"
                        data-url="{{guard_url('settings/chat')}}">
                    <input type="checkbox" name="tasks_list" id="task_">
                    <label class="app-project-name bg-warning"
                        for="">{{trans('settings::setting.title.chat')[0]}}</label>
                    <h3 style="margin-bottom: 10px;">{{trans('settings::setting.title.chat')}}</h3>
                    <div class="app-metas">
                        <p></p>
                        <span class="badge badge-status in-progress"></span>
                    </div>
                </div>
                <div class="app-actions">
                    <a href="{{guard_url('settings/chat')}}" class="btn las la-pencil-alt" data-action='EDIT'
                        data-load-to="#app-entry" data-url="{{guard_url('settings/chat')}}">
                    </a>
                </div>
            </div>
            <div class="app-item ">
                <div class="app-info"  data-action='SHOW' data-load-to="#app-entry"
                        data-url="{{guard_url('settings/google')}}">
                    <input type="checkbox" name="tasks_list" id="task_">
                    <label class="app-project-name bg-primary"
                        for="">{{trans('settings::setting.title.google')[0]}}</label>
                    <h3 style="margin-bottom: 10px;">{{trans('settings::setting.title.google')}}</h3>
                    <div class="app-metas">
                        <p></p>
                        <span class="badge badge-status in-progress"></span>
                    </div>
                </div>
                <div class="app-actions">
                    <a href="{{guard_url('settings/google')}}" class="btn las la-pencil-alt" data-action='EDIT'
                        data-load-to="#app-entry" data-url="{{guard_url('settings/google')}}">
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="app-detail-wrap" id="app-entry">


    </div>
</div>
<script type="">
    var module_link = "{{guard_url('settings/')}}";
    // $("#main-content").load("{{guard_url('settings/main')}}");
</script>