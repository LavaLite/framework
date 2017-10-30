<ul class="dropdown-menu notification">
  <li class="header"> You have {!!count(Task::tasks())!!} Tasks</li>
  <li>
    <!-- inner menu: contains the actual data -->
    <div class="slimScrollDiv" >
    <ul class="menu"  >
      <div id="slim-scroll">
         @forelse(Task::tasks() as $key => $value)
                  <li>
                      <a href="{!!trans_url('/admin/task/task')!!}">
                          <div class="pull-left">
                              <img src="{!!@$value->user->picture!!}" class="img-circle img-responsive" alt="User Image" />
                          </div>
                          <h4>
                              {!!@$value->task!!}
                              <br>                         
                                <small>
                                  <i class="fa fa-clock-o">
                                  </i>
                                <time class="timeago" datetime="{!!@$value['created_at']!!}"></time>
                                 <p>{!! format_date($value->start) !!}-{!! format_date($value->end) !!} </p>
                              </small>

                            </h4>
                           
                          
                      </a>
                  </li>
          @empty
          @endif
      </div>
    </ul>
    </div>
  </li>
  <li class="footer"><a href="{{trans_url('/admin/task/task')}}">View all</a></li>
</ul>
