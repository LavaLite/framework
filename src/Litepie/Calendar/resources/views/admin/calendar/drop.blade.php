  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-calendar"></i>
                  <span class="label label-warning">  {!!count($data)!!}</span>
                </a>
<ul class="dropdown-menu notification">
  <li class="header">   You have {!!count($data)!!} events</li>
  <li>
    <!-- inner menu: contains the actual data -->
    <div class="slimScrollDiv" >
    <ul class="menu"  >
      <div id="slim-scroll">  
          @forelse($data as $key => $value) 
                  <li>
                      <a href="{!!trans_url('/admin/calendar/calendar')!!}">
                          <div class="pull-left">
                              <img src="{!!@$value->user->picture!!}" class="img-circle img-responsive" alt="User Image" />
                          </div>
                          <h4>
                              {!!@$value->title!!}                            
                         <br>
                           <small>
                                  <i class="fa fa-clock-o">
                                  </i>
                                <time class="timeago" datetime="{!!@$value['created_at']!!}"></time>

                            </small>
                           </h4>
                                <p>{!!format_date(@$value['start'])!!} - {!!format_date(@$value['end'])!!}</p>

                      </a>
                  </li>
          @empty
          @endif
      </div>
    </ul>
    </div>
  </li>
  <li class="footer"><a href="{{trans_url('/admin/calendar/calendar')}}">View all</a></li>
</ul>
</script>