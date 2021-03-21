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
                            <a href="{{guard_url("masters/{$v['type']}")}}/master">{{__("master::master.masters.{$v['type']}")}}
                                <span class="pull-right badge bg-blue">{{@$count[$v['type']]}}</span>
                            </a>
                        </h3>
                    </div>
                </div>
                @endforeach
            @endforeach
        </div>