<div class="panel panel-default alt with-footer">
    <div class="heading clearfix">
        <h2 class="title">Activity feed</h2>
        <div class="ctrls">
            <div class="badge badge-info">{!!@count($tasks)!!}</div>
        </div>
    </div>
    <?php $icon=['in_progress'=>'ion-android-sync','to_do'=>'ion-refresh','completed'=>'ion-checkmark-circled'];
     $color=['in_progress'=>'blue','to_do'=>'purple','completed'=>'green']?>
    <div class="panel-body pn" style="max-height: 270px;overflow-x: auto;">
        <ul class="media-list scroll-content mn">
        @forelse($tasks as $key => $value)
            <li class="media b-bl">
                            <a href="#">
                                <div class="media-left">
                                   <span class="icon {!!@$color[$value['status']]!!}"><i class="{!!@$icon[$value['status']]!!}"></i></span>
                                </div>
                                <div class="media-body">
                                    <span class="name">{!!@$value->user['name']!!}</span>  assigned  a task {!!@$value['task']!!}
                                      <span class="time" datetime="{!!$value->created_at!!}" title="{!!$value->created_at!!}"> {!!$value->created_at!!}</span>
                                </div>
                            </a>
                        </li>                               
            @empty
            <li class="media b-bl">
                <div class="media-content">
                    <p>No Task Scheduled</p>
                </div>
            </li>
            @endif
        </ul>
    </div>
    <div class="footer">
        <button class="btn btn-danger btn-raised btn-sm">See more</button>
    </div>
</div>
<script type="text/javascript">
$(function(){
  jQuery(".time").timeago();
})
  
</script>
