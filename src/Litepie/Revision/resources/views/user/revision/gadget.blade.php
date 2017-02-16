<div class="panel panel-default alt with-footer">
    <div class="heading clearfix">
        <h2 class="title">Revision Feed</h2>
        <div class="ctrls">
            <div class="badge badge-info">99</div>
        </div>
    </div>
    <div class="body pn" style="max-height: 245px;overflow-x: auto;">
        <ul class="media-list scroll-content m-n">
            <?php 
                $class = ['Deleted' => 'danger', 'Created' => 'blue', 'Updated' => 'success'];
                $icon  = ['Deleted' => 'ion-close-round', 'Created' => 'pe-7s-plus', 'Updated' => 'ion-checkmark-round'];
            ?>
            @forelse(@$activity as $key => $value)
            <li class="media b-bl">
                <a href="#">
                    <div class="media-left">
                        <span class="icon {{$class[@$value->action]}}"><i class="{{$icon[@$value->action]}}"></i></span>
                    </div>
                    <div class="media-body">
                        <span class="name">{{@$value->name}}</span> .....By {{@$value->user->name}}
                        <span class="time">{{@$value->created_at}}<span class="pull-right">{{@$value->user_info->remote_addr}}</span></span>
                    </div>
                </a>
            </li>
            @empty
            <li class="media b-bl">
                <a href="#">
                    <div class="media-left">
                        <span class="icon success"><i class="ion-checkmark-circled"></i></span>
                    </div>
                    <div class="media-body">
                        No revisions.
                    </div>
                </a>
            </li>
            @endif
        </ul>
    </div>
    <div class="footer">
        <a href="{{url('user/revision/revision')}}" class="btn btn-danger btn-sm btn-raised">See more</a>
    </div>
</div>