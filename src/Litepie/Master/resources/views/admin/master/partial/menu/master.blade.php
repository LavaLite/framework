                    <!-- Widget: user widget style 1 -->
                    <div class="box box-widget widget-user">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header bg-aqua-active">
                            <h3 class="widget-user-username">Masters</h3>
                            <h5 class="widget-user-desc">Main master records</h5>
                        </div>

                        <div class="box-footer">
                           <ul class="nav nav-stacked">
                            @foreach(config('master.masters') as $key => $val)
                                <li><a href="{{guard_url('masters/master/'.$key)}}">{{__('master::master.masters.'.$key)}} <span class="pull-right badge bg-blue">31</span></a></li>
                            @endforeach
                            </ul>
                        </div>
                    </div>