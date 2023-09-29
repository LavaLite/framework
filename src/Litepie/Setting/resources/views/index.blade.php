<div class="app-list-wrap-inner ps ps--active-y" id="app-list">
    @foreach($form['groups'] as $key => $group)
    <div class="app-list-head">
        {{trans('setting::setting.title.' . $key)}}
    </div>
    @foreach($group['groups'] as $k => $g)
    <div class="app-item">
        <div class="app-avatar">
            <div class="app-avatar-image bg-primary">{{trans('setting::setting.title.'. $k)[0]}}</div>
        </div>
        <div class="app-info" data-action='SHOW' data-load-to="#app-entry" data-url="{{guard_url('setting/setting/' . $key . '.' . $k)}}">
            {{trans('setting::setting.title.'  . $k)}}
            <div class="app-metas">
                <span class="badge badge-status in-progress"></span>
            </div>
        </div>
        <div class="app-actions">
            <a href="{{guard_url('setting/setting/general')}}" class="btn las la-pencil-alt" data-action='EDIT'
                data-load-to="#app-entry" data-url="{{guard_url('setting/setting/general')}}">
            </a>
        </div>
    </div>
    @endforeach
    @endforeach
</div>
