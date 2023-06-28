<div class="app-list-wrap-inner">
    @foreach($groups as $key => $group)
    <div class="app-list-head">
        {{$group['label']['name']}}
    </div>
        @foreach($group['items'] as $k => $v)
        <div class="app-item" data-id="task_{{$k}}" style="height: 50px;">

            <div class="app-avatar">
                <div class="app-avatar-image bg-primary">{{$v['label'][0]}}</div>
            </div>
            <div class="app-info" data-action='SHOW' data-load-to="#app-list" data-url="{{guard_url("master/list/{$v['type']}")}}">
                <h3 style="margin-bottom: 10px;">{{$v['label']}}</h3>
                <div class="app-metas">
                    <p></p>
                    <span class="badge badge-status in-progress"></span>
                </div>
            </div>
        </div>
        @endforeach
    @endforeach
</div>