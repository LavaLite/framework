<ul class="dropdown-menu notification">
  <li class="header">   You have {!!count(Calendar::latestEvents())!!} events</li>
  <li>
    <!-- inner menu: contains the actual data -->
    <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 200px;">
    <ul class="menu" style="overflow: hidden; width: 100%; height: 200px;">
      @forelse(Calendar::latestEvents() as $key => $value)
              <li>
                  <a href="{!!trans_url($guard.'/calendar/calendar')!!}">
                      <div class="pull-left">
                          <img src="https://placeimg.com/80/80/people" class="img-circle img-responsive" alt="User Image" />
                      </div>
                      <h4>
                          {!!@$value->title!!}
                          <small>
                              <i class="fa fa-clock-o">
                              </i>
                            <time class="timeago" datetime="{!!@$value['created_at']!!}"></time>
                          </small>
                      </h4>
                      <p>
                          {!!format_date(@$value['start'])!!} - {!!format_date('Y-m-d',strtotime(@$value['end'])!!}
                      </p>
                  </a>
              </li>
              <!-- end calendar -->
      @empty
      @endif
    </ul><div class="slimScrollBar" style="width: 3px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px; background: rgb(0, 0, 0);"></div><div class="slimScrollRail" style="width: 3px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; opacity: 0.2; z-index: 90; right: 1px; background: rgb(51, 51, 51);"></div></div>
  </li>
  <li class="footer"><a href="{{trans_url($guard.'/calendar/calendar')}}">View all</a></li>
</ul>
