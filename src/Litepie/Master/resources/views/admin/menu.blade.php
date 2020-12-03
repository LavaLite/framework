                    <!-- Widget: user widget style 1 -->
                    <div class="box box-widget widget-user">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header bg-{{__("master::master.groups.{$key}.color")}}-active">
                            <h3 class="widget-user-username">{{__("master::master.groups.{$key}.name")}}</h3>
                            <h5 class="widget-user-desc">{{__("master::master.groups.{$key}.title")}}</h5>
                        </div>

                        <div class="box-footer">
                           <ul class="nav nav-stacked">
                            @foreach($group as $k => $v)
                                <li>
                                    <a href="{{guard_url("masters/{$key}/{$v['type']}")}}">{{__("master::master.masters.{$v['type']}")}}
                                        <span class="pull-right badge bg-blue">{{@$count[$v['type']]}}</span>
                                    </a>
                                </li>
                            @endforeach
                            </ul>
                        </div>
                    </div>