<div class="app-items" id="item-list">
            <div class="app-list-header text-capitalize">
                <a data-load-to="#app-list" data-url="{{guard_url('master/master')}}" data-action="SHOW" style="cursor: pointer;">
                    <i class="fas fa-arrow-left"></i> Back  &nbsp; <b>{{$type}}</b>
                </a>
            </div>

            <div class="app-list-wrap-inner">
                @foreach($data as $k => $v)
                <div class="app-item" data-id="task_{{$k}}" style="height: 50px;">
                    <div class="app-avatar">
                        <div class="app-avatar-image bg-primary">{{$v['title'][0]}}</div>
                    </div>
                    <div class="app-info">
                        <h3>
                            <a data-load-to="#app-entry" data-url="{{guard_url('master/master/'.$v['id'])}}" data-action="SHOW">
                                {{$v['title']}}
                                <span class="pull-right badge bg-blue">{{$v['type']}}</span>
                            </a>
                        </h3>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <script type="text/javascript">
        $(function() {
            $('#btn-create').attr('data-url', "{{$form['urls']['new']['url'] . '/' . $type ?? ''}}");
        });
        </script>