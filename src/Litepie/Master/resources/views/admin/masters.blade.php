<div class="app-list-wrap">
    <div class="app-list-inner">
        <div class="app-list-header d-flex align-items-center justify-content-between">
            <h3>{{__('Masters')}}</h3>
        </div>

        <div class="app-list-wrap-inner">
            @foreach($groups as $key => $group)
            <div class="app-list-head">
                {{__("master::master.groups.{$key}.name")}}
            </div>
                @foreach($group as $k => $v)
                <div class="app-item" data-id="task_{{$k}}" style="height: 50px;">
                    <div class="app-info">
                        <input type="checkbox" name="tasks_list" id="task_1">
                        <label class="app-project-name bg-secondary" for="task_1">{{__("master::master.masters.{$v['type']}")[0]}}</label>
                        <h3>
                            <a href="{{guard_url("masters/{$key}/{$v['type']}")}}">{{__("master::master.masters.{$v['type']}")}}
                                <span class="pull-right badge bg-blue">{{@$count[$v['type']]}}</span>
                            </a>
                        </h3>
                    </div>
                </div>
                @endforeach
            @endforeach
        </div>
    </div>
    <div class="app-detail-wrap" id="app-content"></div>
</div>
<script type="">


</script>